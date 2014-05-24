<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-05-20 
 */

namespace Net\Bazzline\Component\CodeGenerator;

/**
 * Class AbstractBasicGenerator
 * @package Net\Bazzline\Component\CodeGenerator
 */
abstract class AbstractBasicGenerator implements GeneratorInterface
{
    /** @var Indention */
    private $indention;

    /**
     * @return $this
     */
    public function __clone()
    {
        $this->clear();
    }

    /**
     * @return string
     */
    final public function __toString()
    {
        return $this->generate();
    }

    /**
     * @return Indention
     */
    final public function getIndention()
    {
        return $this->indention;
    }

    /**
     * @param Indention $indention
     * @return $this
     */
    public function setIndention(Indention $indention)
    {
        $this->indention = $indention;

        return $this;
    }
} 