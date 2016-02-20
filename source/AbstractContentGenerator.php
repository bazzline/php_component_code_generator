<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-26 
 */

namespace Net\Bazzline\Component\CodeGenerator;

/**
 * Class AbstractContentGenerator
 * @package Net\Bazzline\Component\Locator\LocatorGenerator
 */
abstract class AbstractContentGenerator extends AbstractBasicGenerator
{
    /**
     * @param Indention $indention
     * @param null|string|array|GeneratorInterface $content
     * @throws InvalidArgumentException
     */
    public function __construct(Indention $indention, $content = null)
    {
        $this->setIndention($indention);
        if (!is_null($content)) {
            $this->add($content);
        }
    }

    /**
     * @param string|array|GeneratorInterface $content
     * @throws InvalidArgumentException
     */
    abstract public function add($content);

    /**
     * @return int
     */
    abstract public function count();
}