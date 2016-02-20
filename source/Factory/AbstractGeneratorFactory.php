<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-05-20 
 */

namespace Net\Bazzline\Component\CodeGenerator\Factory;

use Net\Bazzline\Component\CodeGenerator\BlockGenerator;
use Net\Bazzline\Component\CodeGenerator\Indention;
use Net\Bazzline\Component\CodeGenerator\LineGenerator;

/**
 * Class AbstractGeneratorFactory
 * @package Net\Bazzline\Component\CodeGenerator\Factory
 */
abstract class AbstractGeneratorFactory implements ContentFactoryInterface
{
    /**
     * @return \Net\Bazzline\Component\CodeGenerator\GeneratorInterface
     */
    public function create()
    {
        $generator = $this->getGenerator();

        $generator->setBlockGenerator($this->getBlockGenerator());
        $generator->setLineGenerator($this->getLineGenerator());
        $generator->setIndention($this->getIndention());

        return $generator;
    }

    /**
     * @return \Net\Bazzline\Component\CodeGenerator\AbstractGenerator
     */
    abstract protected function getGenerator();

    /**
     * @return BlockGenerator
     */
    final protected function getBlockGenerator()
    {
        return new BlockGenerator($this->getLineGenerator(), $this->getIndention());
    }

    /**
     * @return LineGenerator
     */
    final protected function getLineGenerator()
    {
        return new LineGenerator($this->getIndention());
    }

    /**
     * @return Indention
     */
    protected function getIndention()
    {
        return new Indention();
    }
}