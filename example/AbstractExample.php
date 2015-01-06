<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-05-24 
 */

use Net\Bazzline\Component\CodeGenerator\Factory\BlockGeneratorFactory;
use Net\Bazzline\Component\CodeGenerator\Factory\ClassGeneratorFactory;
use Net\Bazzline\Component\CodeGenerator\Factory\ConstantGeneratorFactory;
use Net\Bazzline\Component\CodeGenerator\Factory\DocumentationGeneratorFactory;
use Net\Bazzline\Component\CodeGenerator\Factory\FileGeneratorFactory;
use Net\Bazzline\Component\CodeGenerator\Factory\InterfaceGeneratorFactory;
use Net\Bazzline\Component\CodeGenerator\Factory\LineGeneratorFactory;
use Net\Bazzline\Component\CodeGenerator\Factory\MethodGeneratorFactory;
use Net\Bazzline\Component\CodeGenerator\Factory\PropertyGeneratorFactory;
use Net\Bazzline\Component\CodeGenerator\Factory\TraitGeneratorFactory;
use Net\Bazzline\Component\CodeGenerator\Indention;

/**
 * Class AbstractExample
 * @package Net\Bazzline\Component\CodeGenerator\Example
 */
abstract class AbstractExample
{
    /**
     * @return mixed
     */
    abstract function demonstrate();

    /**
     * @return BlockGeneratorFactory
     */
    final protected function getBlockGeneratorFactory()
    {
        return new BlockGeneratorFactory();
    }

    /**
     * @return ClassGeneratorFactory
     */
    final protected function getClassGeneratorFactory()
    {
        return new ClassGeneratorFactory();
    }

    /**
     * @return ConstantGeneratorFactory
     */
    final protected function getConstantGeneratorFactory()
    {
        return new ConstantGeneratorFactory();
    }

    /**
     * @return DocumentationGeneratorFactory
     */
    final protected function getDocumentationGeneratorFactory()
    {
        return new DocumentationGeneratorFactory();
    }

    /**
     * @return FileGeneratorFactory
     */
    final protected function getFileGeneratorFactory()
    {
        return new FileGeneratorFactory();
    }

    /**
     * @return Indention
     */
    final protected function getIndention()
    {
        return new Indention();
    }

    /**
     * @return LineGeneratorFactory
     */
    final protected function getLineGeneratorFactory()
    {
        return new LineGeneratorFactory();
    }

    /**
     * @return MethodGeneratorFactory
     */
    final protected function getMethodGeneratorFactory()
    {
        return new MethodGeneratorFactory();
    }

    /**
     * @return PropertyGeneratorFactory
     */
    final protected function getPropertyGeneratorFactory()
    {
        return new PropertyGeneratorFactory();
    }

    /**
     * @return InterfaceGeneratorFactory
     */
    final protected function getInterfaceGeneratorFactory()
    {
        return new InterfaceGeneratorFactory();
    }

    /**
     * @return TraitGeneratorFactory
     */
    final protected function getTraitGeneratorFactory()
    {
        return new TraitGeneratorFactory();
    }
} 