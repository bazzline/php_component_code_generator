<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-27 
 */

namespace Net\Bazzline\Component\CodeGenerator;

use Net\Bazzline\Component\CodeGenerator\InvalidArgumentException;
use Net\Bazzline\Component\CodeGenerator\RuntimeException;

/**
 * Class ConstantGenerator
 * @package Net\Bazzline\Component\Locator\LocatorGenerator\Generator
 */
class ConstantGenerator extends AbstractGenerator
{
    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->addGeneratorProperty('name', strtoupper($name), false);

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        if (!is_numeric($value)) {
            $value = '\'' . (string) $value . '\'';
        }

        $this->addGeneratorProperty('value', $value, false);

        return $this;
    }

    /**
     * @throws InvalidArgumentException|RuntimeException
     * @return string
     * @todo implement exception throwing if mandatory parameter is missing
     */
    public function generate()
    {
        if ($this->canBeGenerated()) {
            $this->resetContent();
            $name = $this->getGeneratorProperty('name');
            $value = $this->getGeneratorProperty('value');

            if (is_null($name)
                || is_null($value)) {
                throw new RuntimeException('name and value are mandatory');
            }

            $block = $this->getBlockGenerator();

            $block->add('const ' . $name . ' = ' . $value . ';');
            $this->addContent($block);
        }

        return $this->generateStringFromContent();
    }
}