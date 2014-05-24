<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-05-20 
 */

namespace Net\Bazzline\Component\CodeGenerator\Factory;

use Net\Bazzline\Component\CodeGenerator\Indention;
use Net\Bazzline\Component\CodeGenerator\LineGenerator;

/**
 * Class LineGeneratorFactory
 * @package Net\Bazzline\Component\CodeGenerator\Factory
 */
class LineGeneratorFactory implements ContentFactoryInterface
{
    /**
     * @return \Net\Bazzline\Component\CodeGenerator\GeneratorInterface|\Net\Bazzline\Component\CodeGenerator\LineGenerator
     */
    public function create()
    {
        return new LineGenerator($this->getNewIndention());
    }

    /**
     * @return Indention
     */
    private function getNewIndention()
    {
        return new Indention();
    }
}