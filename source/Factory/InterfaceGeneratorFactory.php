<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-01-04 
 */

namespace Net\Bazzline\Component\CodeGenerator\Factory;

use Net\Bazzline\Component\CodeGenerator\InterfaceGenerator;

/**
 * Class InterfaceGeneratorFactory
 * @package Net\Bazzline\Component\CodeGenerator\Factory
 */
class InterfaceGeneratorFactory extends AbstractGeneratorFactory
{
    /**
     * This method is just there for type hinting
     * @return \Net\Bazzline\Component\CodeGenerator\InterfaceGenerator
     */
    public function create()
    {
        return parent::create();
    }

    /**
     * @return \Net\Bazzline\Component\CodeGenerator\GeneratorInterface
     */
    protected function getGenerator()
    {
        return new InterfaceGenerator();
    }
}