<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-01-04 
 */

namespace Net\Bazzline\Component\CodeGenerator;

/**
 * Class SignatureGenerator
 * @package Net\Bazzline\Component\CodeGenerator
 */
class SignatureGenerator extends AbstractDocumentedGenerator
{
    /**
     * @var boolean
     */
    private $addEmptyLine;

    /**
     * @param ConstantGenerator $constant
     * @return $this
     */
    public function addConstant(ConstantGenerator $constant)
    {
        $this->addGeneratorProperty('constants', $constant);

        return $this;
    }

    /**
     * @param MethodGenerator $method
     * @return $this
     */
    public function addMethod(MethodGenerator $method)
    {
        $this->addGeneratorProperty('methods', $method);

        return $this;
    }

    /**
     * @param string $fullQualifiedClassName
     * @param string $alias
     * @return $this
     */
    public function addUse($fullQualifiedClassName, $alias = '')
    {
        $use = array(
            'alias' => $alias,
            'name'  => $fullQualifiedClassName
        );

        $this->addGeneratorProperty('uses', $use);

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->addGeneratorProperty('name', (string) $name, false);

        return $this;
    }

    /**
     * @param string $namespace
     * @return $this
     */
    public function setNamespace($namespace)
    {
        $this->addGeneratorProperty('namespace', (string) $namespace, false);

        return $this;
    }

    /**
     * @throws InvalidArgumentException|RuntimeException
     * @return string
     * @todo implement exception throwing if mandatory parameter is missing
     * @todo decouple/move fitting areas to ClassGenerator and InterfaceGenerator
     */
    public function generate()
    {
        if ($this->canBeGenerated()) {
            $this->executePregenertionHook();
            $this->addEmptyLine = false;
            $this->resetContent();
            $this->generateNamespace();
            $this->generateUse();
            $this->generateDocumentation();
            $this->generateSignature();
            $this->generateBody();
        }

        return $this->generateStringFromContent();
    }

    protected function executePregenertionHook() {}

    private function generateBody()
    {
        $this->addEmptyLine = false;
        $this->addContent('{');
        /** @var null|ConstantGenerator[] $constants */
        $constants = $this->getGeneratorProperty('constants');
        /** @var null|MethodGenerator[] $methods */
        $methods = $this->getGeneratorProperty('methods');
        /** @var null|PropertyGenerator[] $properties */
        $properties = $this->getGeneratorProperty('properties');
        /** @var null|array $traits */
        $traits = $this->getGeneratorProperty('traits');

        if (is_array($traits)) {
            $this->addContent('use ' . implode(',', $traits) . ';', true);
            $this->addEmptyLine = true;
        }
        if (is_array($constants)) {
            if ($this->addEmptyLine) {
                $this->addContent('');
            }
            $lastArrayKey = $this->getLastArrayKey($constants);
            foreach($constants as $key => $constant) {
                $this->addGeneratorAsContent($constant, true);
                if ($key !== $lastArrayKey) {
                    $this->addContent('');
                }
            }
            $this->addEmptyLine = true;
        }
        if (is_array($properties)) {
            if ($this->addEmptyLine) {
                $this->addContent('');
            }
            $lastArrayKey = $this->getLastArrayKey($properties);
            foreach($properties as $key => $property) {
                $this->addGeneratorAsContent($property, true);
                if ($key !== $lastArrayKey) {
                    $this->addContent('');
                }
            }
            $this->addEmptyLine = true;
        }
        if (is_array($methods)) {
            if ($this->addEmptyLine) {
                $this->addContent('');
            }
            $lastArrayKey = $this->getLastArrayKey($methods);
            foreach($methods as $key => $method) {
                $this->addGeneratorAsContent($method, true);
                if ($key !== $lastArrayKey) {
                    $this->addContent('');
                }
            }
        }

        $this->addContent('}');
        $this->addEmptyLine = false;
    }

    private function generateNamespace()
    {
        $namespace = $this->getGeneratorProperty('namespace');

        if (!is_null($namespace)) {
            $this->addContent(
                $this->getLineGenerator(
                    'namespace ' . $namespace . ';'
                )
            );
            $this->addEmptyLine = true;
        }
    }

    private function generateDocumentation()
    {
        $documentation = $this->getGeneratorProperty('documentation');

        if ($documentation instanceof DocumentationGenerator) {
            if ($this->completeDocumentationAutomatically) {
                $isInterface    = $this->getGeneratorProperty('interface', false);
                $name           = $this->getGeneratorProperty('name');
                $namespace      = $this->getGeneratorProperty('namespace');

                if (is_string($name)) {
                    //@todo decouple/move fitting areas to ClassGenerator and InterfaceGenerator
                    if ($isInterface) {
                        $documentation->setInterface($name);
                    } else {
                        $documentation->setClass($name);
                    }
                }
                if (is_string($namespace)) {
                    $documentation->setPackage($namespace);
                }
            }
            if ($documentation->hasContent()) {
                if ($this->addEmptyLine) {
                    $this->addContent('');
                    $this->addEmptyLine = false;
                }
                $this->addGeneratorAsContent($documentation);
            }
        }
    }

    /**
     * @throws \Net\Bazzline\Component\CodeGenerator\RuntimeException
     */
    private function generateSignature()
    {
        $isAbstract     = $this->getGeneratorProperty('abstract', false);
        $isInterface    = $this->getGeneratorProperty('interface', false);
        $isFinal        = $this->getGeneratorProperty('final', false);
        $extends        = $this->getGeneratorProperty('extends');
        $implements     = $this->getGeneratorProperty('implements');
        $name           = $this->getGeneratorProperty('name');

        if (is_null($name)) {
            throw new RuntimeException('name is mandatory');
        }

        if ($this->addEmptyLine) {
            $this->addContent('');
            $this->addEmptyLine = false;
        }

        $line = $this->getLineGenerator();
        if ($isAbstract) {
            $line->add('abstract');
        } else if ($isInterface) {
            $line->add('interface');
        } else if ($isFinal) {
            $line->add('final');
        }

        //@todo decouple/move fitting areas to ClassGenerator and InterfaceGenerator
        if ($isInterface) {
            $line->add($name);

            if (is_array($extends)) {
                $line->add('extends');
                $line->add(implode(', ', $extends));
            }
        } else {
            $line->add('class ' . $name);

            if (is_string($extends)) {
                $line->add('extends');
                $line->add($extends);
            }
        }

        if (is_array($implements)) {
            $line->add('implements');
            $line->add(implode(', ', $implements));
        }

        $this->addContent($line);
        $this->addEmptyLine = true;
    }

    private function generateUse()
    {
        $uses = $this->getGeneratorProperty('uses');

        if (is_array($uses)) {
            if ($this->addEmptyLine) {
                $this->addContent('');
                $this->addEmptyLine = false;
            }
            foreach ($uses as $use) {
                $line = $this->getLineGenerator();
                if (strlen($use['alias']) > 0) {
                    $line->add('use ' . $use['name'] . ' as ' . $use['alias'] . ';');
                } else {
                    $line->add('use ' . $use['name'] . ';');
                }
                $this->addContent($line);
            }
            $this->addEmptyLine = true;
        }
    }
}