<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-01-06 
 */

namespace Net\Bazzline\Component\CodeGenerator\Factory;

use Net\Bazzline\Component\CodeGenerator\SignatureGenerator;

/**
 * Class SignatureGeneratorFactory
 * @package Net\Bazzline\Component\CodeGenerator\Factory
 */
class SignatureGeneratorFactory extends AbstractGeneratorFactory
{
    /**
     * This method is just there for type hinting
     * @return \Net\Bazzline\Component\CodeGenerator\SignatureGenerator
     */
    public function create()
    {
        return parent::create();
    }

    /**
     * @return \Net\Bazzline\Component\CodeGenerator\SignatureGenerator
     */
    protected function getGenerator()
    {
        return new SignatureGenerator();
    }
}