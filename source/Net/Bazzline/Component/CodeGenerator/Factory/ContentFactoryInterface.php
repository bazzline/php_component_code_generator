<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-05-20 
 */

namespace Net\Bazzline\Component\CodeGenerator\Factory;

/**
 * Interface ContentFactoryInterface
 * @package Net\Bazzline\Component\CodeGenerator\Factory
 */
interface ContentFactoryInterface
{
    /**
     * @return \Net\Bazzline\Component\CodeGenerator\GeneratorInterface
     */
    public function create();
}