<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-27 
 */

namespace Net\Bazzline\Component\CodeGenerator;

use Net\Bazzline\Component\CodeGenerator\InvalidArgumentException;
use Net\Bazzline\Component\CodeGenerator\RuntimeException;

/**
 * Class PropertyGenerator
 * @package Net\Bazzline\Component\Locator\LocatorGenerator\Generator
 */
class PropertyGenerator extends AbstractDocumentedGenerator
{
    /**
     * @param string $typeHint
     * @return $this
     */
    public function addTypeHint($typeHint)
    {
        $this->addGeneratorProperty('type_hints', (string) $typeHint);

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
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->addGeneratorProperty('value', (string) $value, false);

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
        $documentation  = $this->getGeneratorProperty('documentation');
        $isStatic       = $this->getGeneratorProperty('static', false);
        $name           = $this->getGeneratorProperty('name');
        $typeHints      = $this->getGeneratorProperty('type_hints', []);
        $value          = $this->getGeneratorProperty('value');
        $visibility     = $this->getGeneratorProperty('visibility');

        if (is_null($name)) {
            throw new RuntimeException('name is mandatory');
        }

        $block = $this->getBlockGenerator();
        $line = $this->getLineGenerator();

        if ($documentation instanceof DocumentationGenerator) {
            if ($this->completeDocumentationAutomatically === true) {
                $documentation->setVariable($name, $typeHints);
            }
            $block->add(explode(PHP_EOL, $documentation->generate()));
        }

        if (!is_null($visibility)) {
            $line->add($visibility);
        }

        if ($isStatic) {
            $line->add('static');
        }
        if (!is_null($value)) {
            $line->add('$' . $name . ' = ' . $value . ';');
        } else {
            $line->add('$' . $name . ';');
        }
        $block->add($line);
        $this->addContent($block);

        return $this->generateStringFromContent();
    }
}
