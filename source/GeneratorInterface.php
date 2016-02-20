<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-24 
 */

namespace Net\Bazzline\Component\CodeGenerator;

/**
 * Interface GeneratorInterface
 * @package Net\Bazzline\Component\Locator\LocatorGenerator\Generator
 */
interface GeneratorInterface extends IndentionAwareInterface
{
    /**
     * @return $this
     */
    public function clear();

    /**
     * @return $this
     */
    public function __clone();

    /**
     * @throws InvalidArgumentException|RuntimeException
     * @return string
     */
    public function generate();

    /**
     * @return boolean
     */
    public function hasContent();

    /**
     * @return string
     */
    public function __toString();
}