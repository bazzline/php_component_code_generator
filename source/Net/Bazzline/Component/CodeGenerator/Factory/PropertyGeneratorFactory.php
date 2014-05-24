<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-05-20 
 */

namespace Net\Bazzline\Component\CodeGenerator\Factory;

use Net\Bazzline\Component\CodeGenerator\PropertyGenerator;

/**
 * Class PropertyGeneratorFactory
 * @package Net\Bazzline\Component\CodeGenerator\Factory
 */
class PropertyGeneratorFactory extends AbstractGeneratorFactory
{
    /**
     * This method is just there for type hinting
     * @return \Net\Bazzline\Component\CodeGenerator\PropertyGenerator
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
        return new PropertyGenerator();
    }
}