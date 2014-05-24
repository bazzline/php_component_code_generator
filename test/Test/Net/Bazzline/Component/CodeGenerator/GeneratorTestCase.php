<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-27 
 */

namespace Test\Net\Bazzline\Component\CodeGenerator;

use Net\Bazzline\Component\CodeGenerator\BlockGenerator;
use Net\Bazzline\Component\CodeGenerator\ClassGenerator;
use Net\Bazzline\Component\CodeGenerator\ConstantGenerator;
use Net\Bazzline\Component\CodeGenerator\DocumentationGenerator;
use Net\Bazzline\Component\CodeGenerator\FileGenerator;
use Net\Bazzline\Component\CodeGenerator\GeneratorInterface;
use Net\Bazzline\Component\CodeGenerator\Indention;
use Net\Bazzline\Component\CodeGenerator\LineGenerator;
use Net\Bazzline\Component\CodeGenerator\MethodGenerator;
use Net\Bazzline\Component\CodeGenerator\PropertyGenerator;
use Net\Bazzline\Component\CodeGenerator\TraitGenerator;
use PHPUnit_Framework_TestCase;
use Mockery;

/**
 * Class GeneratorTestCase
 * @package Test\Net\Bazzline\Component\CodeGenerator
 */
class GeneratorTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    private $factoryInstancePool = array();

    //----begin of general----
    protected function tearDown()
    {
        Mockery::close();
    }

    /**
     * @return Indention
     */
    protected function getIndention()
    {
        return new Indention();
    }

    /**
     * @param string $fullQualifiedClassName
     * @return Mockery\MockInterface
     */
    protected function getMockeryMock($fullQualifiedClassName)
    {
        return Mockery::mock($fullQualifiedClassName);
    }

    /**
     * @param GeneratorInterface $generator
     */
    protected function debugGenerator(GeneratorInterface $generator)
    {
        echo PHP_EOL . '----' . PHP_EOL . $generator->generate() . PHP_EOL . '----' . PHP_EOL;
    }
    //----end of general----

    //----begin of generator----
    /**
     * @param Indention $indention
     * @return BlockGenerator|GeneratorInterface
     */
    protected function getBlockGenerator(Indention $indention = null)
    {
        $generator = $this->getBlockGeneratorFactory()->create();

        if (is_null($indention)) {
            $indention = $this->getIndention();
        }
        $generator->setIndention($indention);

        return $generator;
    }

    /**
     * @param Indention $indention
     * @return ClassGenerator
     */
    protected function getClassGenerator(Indention $indention = null)
    {
        $generator = $this->getClassGeneratorFactory()->create();


        return $generator;
    }

    /**
     * @param Indention $indention
     * @return ConstantGenerator
     */
    protected function getConstantGenerator(Indention $indention = null)
    {
        $generator = $this->getConstantGeneratorFactory()->create();

        if (is_null($indention)) {
            $indention = $this->getIndention();
        }
        $generator->setIndention($indention);

        return $generator;
    }

    /**
     * @param Indention $indention
     * @return FileGenerator
     */
    protected function getFileGenerator(Indention $indention = null)
    {
        $generator = $this->getFileGeneratorFactory()->create();

        if (is_null($indention)) {
            $indention = $this->getIndention();
        }
        $generator->setIndention($indention);

        return $generator;
    }

    /**
     * @param Indention $indention
     * @return LineGenerator
     */
    protected function getLineGenerator(Indention $indention = null)
    {
        $generator = $this->getLineGeneratorFactory()->create();

        if (is_null($indention)) {
            $indention = $this->getIndention();
        }
        $generator->setIndention($indention);

        return $generator;
    }

    /**
     * @param Indention $indention
     * @return MethodGenerator
     */
    protected function getMethodGenerator(Indention $indention = null)
    {
        $generator = $this->getMethodGeneratorFactory()->create();

        if (is_null($indention)) {
            $indention = $this->getIndention();
        }
        $generator->setIndention($indention);

        return $generator;
    }

    /**
     * @param Indention $indention
     * @return DocumentationGenerator
     */
    protected function getDocumentationGenerator(Indention $indention = null)
    {
        $generator = $this->getDocumentationGeneratorFactory()->create();

        if (is_null($indention)) {
            $indention = $this->getIndention();
        }
        $generator->setIndention($indention);

        return $generator;
    }

    /**
     * @param Indention $indention
     * @return PropertyGenerator
     */
    protected function getPropertyGenerator(Indention $indention = null)
    {
        $generator = $this->getPropertyGeneratorFactory()->create();

        if (is_null($indention)) {
            $indention = $this->getIndention();
        }
        $generator->setIndention($indention);

        return $generator;
    }

    /**
     * @param Indention $indention
     * @return TraitGenerator
     */
    protected function getTraitGenerator(Indention $indention = null)
    {
        $generator = $this->getTraitGeneratorFactory()->create();

        if (is_null($indention)) {
            $indention = $this->getIndention();
        }
        $generator->setIndention($indention);

        return $generator;
    }
    //----end of generator----

    //----begin of factory instance pool
    /**
     * @param $className
     * @return \Net\Bazzline\Component\CodeGenerator\Factory\AbstractGeneratorFactory
     */
    private function getFactoryFromInstancePool($className)
    {
        $namespacedClassName = '\\Net\\Bazzline\\Component\\CodeGenerator\\Factory\\' . $className;
        if (!isset($this->factoryInstancePool[$namespacedClassName])) {
            $this->factoryInstancePool[$namespacedClassName] = new $namespacedClassName();
        }

        return $this->factoryInstancePool[$namespacedClassName];
    }

    /**
     * @return \Net\Bazzline\Component\CodeGenerator\Factory\BlockGeneratorFactory
     */
    private function getBlockGeneratorFactory()
    {
        return $this->getFactoryFromInstancePool('BlockGeneratorFactory');
    }

    /**
     * @return \Net\Bazzline\Component\CodeGenerator\Factory\PropertyGeneratorFactory
     */
    private function getPropertyGeneratorFactory()
    {
        return $this->getFactoryFromInstancePool('PropertyGeneratorFactory');
    }

    /**
     * @return \Net\Bazzline\Component\CodeGenerator\Factory\ClassGeneratorFactory
     */
    private function getClassGeneratorFactory()
    {
        return $this->getFactoryFromInstancePool('ClassGeneratorFactory');
    }

    /**
     * @return \Net\Bazzline\Component\CodeGenerator\Factory\ConstantGeneratorFactory
     */
    private function getConstantGeneratorFactory()
    {
        return $this->getFactoryFromInstancePool('ConstantGeneratorFactory');
    }

    /**
     * @return \Net\Bazzline\Component\CodeGenerator\Factory\FileGeneratorFactory
     */
    private function getFileGeneratorFactory()
    {
        return $this->getFactoryFromInstancePool('FileGeneratorFactory');
    }

    /**
     * @return \Net\Bazzline\Component\CodeGenerator\Factory\LineGeneratorFactory
     */
    private function getLineGeneratorFactory()
    {
        return $this->getFactoryFromInstancePool('LineGeneratorFactory');
    }

    /**
     * @return \Net\Bazzline\Component\CodeGenerator\Factory\MethodGeneratorFactory
     */
    private function getMethodGeneratorFactory()
    {
        return $this->getFactoryFromInstancePool('MethodGeneratorFactory');
    }

    /**
     * @return \Net\Bazzline\Component\CodeGenerator\Factory\DocumentationGeneratorFactory
     */
    private function getDocumentationGeneratorFactory()
    {
        return $this->getFactoryFromInstancePool('DocumentationGeneratorFactory');
    }

    /**
     * @return \Net\Bazzline\Component\CodeGenerator\Factory\TraitGeneratorFactory
     */
    private function getTraitGeneratorFactory()
    {
        return $this->getFactoryFromInstancePool('TraitGeneratorFactory');
    }
    //----end of factory instance pool
}