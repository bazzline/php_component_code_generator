<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-24 
 */

namespace Net\Bazzline\Component\CodeGenerator;

/**
 * Class MethodGenerator
 * @package Net\Bazzline\Component\Locator\LocatorGenerator\Generator
 */
class MethodGenerator extends AbstractDocumentedGenerator
{
    /**
     * @param string $name
     * @param string $defaultValue
     * @param string $typeHint
     * @param bool $isReference
     * @return $this
     */
    public function addParameter($name, $defaultValue = '', $typeHint = '', $isReference = false)
    {
        $parameter = array(
            'default_value' => $defaultValue,
            'name'          => $name,
            'is_reference'  => $isReference,
            'type_hint'     => $typeHint
        );

        $this->addGeneratorProperty('parameters', $parameter);

        return $this;
    }

    /**
     * @param float|string $version
     * @param string $description
     * @return $this
     * @see http://www.phpdoc.org/docs/latest/for-users/phpdoc/tags/since.html
     */
    public function addSince($version, $description = '')
    {
        $since = array(
            'description'   => $description,
            'version'       => $version
        );

        $this->addGeneratorProperty('since_versions', $since);

        return $this;
    }

    /**
     * @return null|array
     */
    public function getBody()
    {
        return $this->getGeneratorProperty('body', null);
    }

    /**
     * @param string|array|LineGenerator|BlockGenerator $body
     * @param array $returnValueTypeHints
     * @return $this
     */
    public function setBody($body, $returnValueTypeHints = array())
    {
        $this->addGeneratorProperty('body', $body, false);
        $this->addGeneratorProperty('has_body', true, false);
        $this->addGeneratorProperty('body_return_value_type_hints', $returnValueTypeHints, false);

        return $this;
    }

    /**
     * @return $this
     */
    public function markAsAbstract()
    {
        $this->addGeneratorProperty('abstract', true, false);

        return $this;
    }

    /**
     * @return $this
     */
    public function markAsHasNoBody()
    {
        $this->addGeneratorProperty('has_body', false, false);

        return $this;
    }

    /**
     * @return $this
     */
    public function markAsFinal()
    {
        $this->addGeneratorProperty('final', true, false);

        return $this;
    }

    /**
     * @return $this
     */
    public function markAsPrivate()
    {
        $this->addGeneratorProperty('visibility', 'private', false);

        return $this;
    }

    /**
     * @return $this
     */
    public function markAsProtected()
    {
        $this->addGeneratorProperty('visibility', 'protected', false);

        return $this;
    }

    /**
     * @return $this
     */
    public function markAsPublic()
    {
        $this->addGeneratorProperty('visibility', 'public', false);

        return $this;
    }

    /**
     * @return $this
     */
    public function markAsStatic()
    {
        $this->addGeneratorProperty('static', true, false);

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
     * @throws InvalidArgumentException|RuntimeException
     * @return string
     * @todo implement exception throwing if mandatory parameter is missing
     */
    public function generate()
    {
        $this->resetContent();
        $this->generateDocumentation();
        $this->generateSignature();
        $this->generateBody();

        return $this->generateStringFromContent();
    }

    private function generateBody()
    {
        $body       = $this->getGeneratorProperty('body', array('//@todo implement'));
        $isAbstract = $this->getGeneratorProperty('abstract', false);
        $hasBody    = $this->getGeneratorProperty('has_body', true);

        if (!$isAbstract
            && $hasBody) {
            $this->addContent('{');
            if (!($body instanceof BlockGenerator)
                || !($body instanceof LineGenerator)) {
                if (!is_array($body)) {
                    $body = array($body);
                }
                $body = $this->getBlockGenerator($body);
            }
            $this->addGeneratorAsContent(
                $body,
                true
            );
            $this->addContent('}');
        }
    }

    private function generateDocumentation()
    {
        $documentation = $this->getGeneratorProperty('documentation');

        if ($documentation instanceof DocumentationGenerator) {
            if ($this->completeDocumentationAutomatically === true) {
                $parameters         = $this->getGeneratorProperty('parameters', array());
                $returnTypeHints    = $this->getGeneratorProperty('body_return_value_type_hints');

                foreach ($parameters as $parameter) {
                    $documentation->addParameter($parameter['name'], $parameter['type_hint']);
                }
                if (is_array($returnTypeHints)) {
                    $documentation->setReturn($returnTypeHints);
                }
            }
            $this->addGeneratorAsContent($documentation);
        }
    }

    private function generateSignature()
    {
        if ($this->canBeGenerated()) {
            $hasBody        = $this->getGeneratorProperty('has_body', true);
            $isAbstract     = $this->getGeneratorProperty('abstract', false);
            $isFinal        = $this->getGeneratorProperty('final', false);
            $isStatic       = $this->getGeneratorProperty('static', false);
            $name           = $this->getGeneratorProperty('name');
            $parameters     = $this->getGeneratorProperty('parameters', array());
            $visibility     = $this->getGeneratorProperty('visibility');

            //@todo refactor the wired usage for line and block generator
            $line = $this->getLineGenerator();

            if ($isAbstract) {
                $line->add('abstract');
            } else if ($isFinal) {
                $line->add('final');
            }

            if (!is_null($visibility)) {
                $line->add($visibility);
            }

            if ($isStatic) {
                $line->add('static');
            }

            $parametersLine = $this->getLineGenerator();
            $parametersLine->setSeparator(', ');
            if (is_array($parameters)) {
                foreach ($parameters as $parameter) {
                    $parameterLine = $this->getLineGenerator();
                    if ((strlen($parameter['type_hint']) > 0)
                        && (!in_array($parameter['type_hint'], $this->getNotPrintableTypeHints()))) {
                        $parameterLine->add($parameter['type_hint']);
                    }
                    $parameterLine->add(($parameter['is_reference'] ? '&' : '') . '$' . $parameter['name']);
                    if (strlen((string) $parameter['default_value']) > 0) {
                        $parameterLine->add('= ' . (string) $parameter['default_value']);
                    }
                    $parametersLine->add($parameterLine);
                }
            }

            $line->add('function ' . $name . '(' . $parametersLine->generate() . ')' . ((($isAbstract) || (!$hasBody)) ? ';' : ''));
            $block = $this->getBlockGenerator($line);
            $this->addContent($block);
        }
    }
}