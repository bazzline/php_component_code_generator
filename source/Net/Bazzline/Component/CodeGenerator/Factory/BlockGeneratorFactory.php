<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-05-20 
 */

namespace Net\Bazzline\Component\CodeGenerator\Factory;

use Net\Bazzline\Component\CodeGenerator\BlockGenerator;
use Net\Bazzline\Component\CodeGenerator\Indention;

/**
 * Class BlockGeneratorFactory
 * @package Net\Bazzline\Component\CodeGenerator\Factory
 */
class BlockGeneratorFactory implements ContentFactoryInterface
{
    /**
     * @var LineGeneratorFactory
     */
    private $lineFactory;

    /**
     * @return \Net\Bazzline\Component\CodeGenerator\GeneratorInterface|\Net\Bazzline\Component\CodeGenerator\BlockGenerator
     */
    public function create()
    {
        return new BlockGenerator($this->getLineFactory()->create(), $this->getNewIndention());
    }

    /**
     * @return LineGeneratorFactory
     */
    private function getLineFactory()
    {
        if (is_null($this->lineFactory)) {
            $this->lineFactory = new LineGeneratorFactory();
        }

        return $this->lineFactory;
    }

    /**
     * @return Indention
     */
    private function getNewIndention()
    {
        return new Indention();
    }
}