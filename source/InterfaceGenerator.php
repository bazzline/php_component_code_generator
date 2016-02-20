<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-01-04 
 */

namespace Net\Bazzline\Component\CodeGenerator;

/**
 * Class InterfaceGenerator
 * @package Net\Bazzline\Component\CodeGenerator
 */
class InterfaceGenerator extends SignatureGenerator
{
    /**
     * @param string $name
     * @param boolean $addToUse
     * @return $this
     */
    public function addExtends($name, $addToUse = false)
    {
        $this->addGeneratorProperty('extends', (string) $name);

        if ($addToUse) {
            $this->addUse($name);
        }

        return $this;
    }

    protected function executePregenertionHook()
    {
        $this->addGeneratorProperty('interface', true, false);
    }
}