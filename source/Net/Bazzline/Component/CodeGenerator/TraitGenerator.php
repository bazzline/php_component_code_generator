<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-26 
 */

namespace Net\Bazzline\Component\CodeGenerator;

/**
 * Class TraitGenerator
 * @package Net\Bazzline\Component\Locator\LocatorGenerator\Generator
 */
class TraitGenerator extends AbstractDocumentedGenerator
{
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
     * @param PropertyGenerator $property
     * @return $this
     */
    public function addProperty(PropertyGenerator $property)
    {
        $this->addGeneratorProperty('properties', $property);

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
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->addGeneratorProperty('name', (string) $name, false);

        return $this;
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->getGeneratorProperty('name');
    }

    /**
     * @throws InvalidArgumentException|RuntimeException
     * @return string
     * @todo implement exception throwing if mandatory parameter is missing
     */
    public function generate()
    {
        if ($this->canBeGenerated()) {
            if (is_null($this->getGeneratorProperty('name'))) {
                throw new RuntimeException('name is mandatory');
            }

            $this->resetContent();
            $this->generateDocumentation();
            $this->generateSignature();
            $this->generateBody();
        }

        return $this->generateStringFromContent();
    }

    private function generateBody()
    {
        $addEmptyLine = false;
        $this->addContent('{');
        /** @var null|ConstantGenerator[] $constants */
        $constants = $this->getGeneratorProperty('constants');
        /** @var null|MethodGenerator[] $methods */
        $methods = $this->getGeneratorProperty('methods');
        /** @var null|PropertyGenerator[] $properties */
        $properties = $this->getGeneratorProperty('properties');

        if (is_array($constants)) {
            $lastArrayKey = $this->getLastArrayKey($constants);
            foreach($constants as $key => $constant) {
                $this->addGeneratorAsContent($constant, true);
                if ($key !== $lastArrayKey) {
                    $this->addContent('');
                }
            }
            $addEmptyLine = true;
        }
        if (is_array($properties)) {
            if ($addEmptyLine) {
                $this->addContent('');
            }
            $lastArrayKey = $this->getLastArrayKey($properties);
            foreach($properties as $key => $property) {
                $this->addGeneratorAsContent($property, true);
                if ($key !== $lastArrayKey) {
                    $this->addContent('');
                }
            }
            $addEmptyLine = true;
        }
        if (is_array($methods)) {
            if ($addEmptyLine) {
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
    }

    private function generateDocumentation()
    {
        $documentation = $this->getGeneratorProperty('documentation');

        if ($documentation instanceof DocumentationGenerator) {
            if ($this->completeDocumentationAutomatically === true) {
                $name = $this->getGeneratorProperty('name');

                if (is_string($name)) {
                    $documentation->setClass($name);
                }
            }
            $this->addGeneratorAsContent($documentation);
        }
    }

    /**
     * @throws \Net\Bazzline\Component\CodeGenerator\RuntimeException
     */
    private function generateSignature()
    {
        $name = $this->getGeneratorProperty('name');

        if (is_null($name)) {
            throw new RuntimeException('name is mandatory');
        }

        $line = $this->getLineGenerator('trait ' . $name);
        $this->addContent($line);
    }
}
