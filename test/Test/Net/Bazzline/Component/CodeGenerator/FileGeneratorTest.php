<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-05-14 
 */

namespace Test\Net\Bazzline\Component\CodeGenerator;

/**
 * Class FileGeneratorTest
 * @package Test\Net\Bazzline\Component\CodeGenerator
 */
class FileGeneratorTest extends GeneratorTestCase
{
    public function testWithNoProperties()
    {
        $generator = $this->getFileGenerator();
        $this->assertEquals('', $generator->generate());
    }

    public function testWithConstants()
    {
        $constantBar = $this->getConstantGenerator();
        $constantFoo = $this->getConstantGenerator();
        $generator = $this->getFileGenerator();
        $indention = $this->getIndention();

        $constantBar->setName('BAR');
        $constantBar->setValue('foo');
        $constantFoo->setName('FOO');
        $constantFoo->setValue(42);

        $generator->addConstant($constantBar);
        $generator->addConstant($constantFoo);

        $expectedContent = '<?php' . PHP_EOL .
            $indention . PHP_EOL .
            $indention . 'const BAR = \'foo\';' . PHP_EOL .
            $indention . PHP_EOL .
            $indention . 'const FOO = 42;';

        $this->assertEquals($expectedContent, $generator->generate());
    }

    public function testWithProperties()
    {
        $generator = $this->getFileGenerator();
        $indention = $this->getIndention();
        $propertyBar = $this->getPropertyGenerator();
        $propertyFoo = $this->getPropertyGenerator();

        $propertyBar->setName('bar');
        $propertyBar->markAsPublic();
        $propertyBar->setValue('\'foo\'');
        $propertyFoo->setName('foo');
        $propertyFoo->setValue('\'bar\'');
        $propertyFoo->markAsPrivate();

        $generator->addProperty($propertyBar);
        $generator->addProperty($propertyFoo);

        $expectedContent = '<?php' . PHP_EOL .
            $indention . PHP_EOL .
            $indention . 'public $bar = \'foo\';' . PHP_EOL .
            $indention . PHP_EOL .
            $indention . 'private $foo = \'bar\';';

        $this->assertEquals($expectedContent, $generator->generate());
    }

    public function testWithClasses()
    {
        $classBar = $this->getClassGenerator();
        $classFoo = $this->getClassGenerator();
        $generator = $this->getFileGenerator();
        $indention = $this->getIndention();

        $classBar->setName('bar');
        $classFoo->setName('foo');

        $generator->addClass($classBar);
        $generator->addClass($classFoo);

        $expectedContent = '<?php' . PHP_EOL .
            $indention . PHP_EOL .
            $indention . 'class bar' . PHP_EOL .
            $indention . '{' . PHP_EOL .
            $indention . '}' . PHP_EOL .
            $indention . PHP_EOL .
            $indention . 'class foo' . PHP_EOL .
            $indention . '{' . PHP_EOL .
            $indention . '}';

        $this->assertEquals($expectedContent, $generator->generate());
    }

    public function testWithMethods()
    {
        $generator = $this->getFileGenerator();
        $indention = $this->getIndention();
        $methodBar = $this->getMethodGenerator($generator->getIndention());
        $methodFoo = $this->getMethodGenerator($generator->getIndention());

        $methodBar->setName('bar');
        $methodBar->markAsPublic();
        $methodFoo->setName('foo');
        $methodFoo->markAsProtected();

        $generator->addMethod($methodBar);
        $generator->addMethod($methodFoo);

        $indention->increaseLevel();
        $doubledIndention = $indention->toString();
        $indention->decreaseLevel();

        $expectedContent = '<?php' . PHP_EOL .
            $indention . PHP_EOL .
            $indention . 'public function bar()' . PHP_EOL .
            $indention . '{' . PHP_EOL .
            $doubledIndention . '//@todo implement' . PHP_EOL .
            $indention . '}' . PHP_EOL .
            $indention . PHP_EOL .
            $indention . 'protected function foo()' . PHP_EOL .
            $indention . '{' . PHP_EOL .
            $doubledIndention . '//@todo implement' . PHP_EOL .
            $indention . '}';

        $this->assertEquals($expectedContent, $generator->generate());
    }

    public function testWithContent()
    {
        $content = array(
            '//@todo implement',
        );
        $generator = $this->getFileGenerator();

        $indention = $this->getIndention();
        $generator->addFileContent($content);

        $expectedContent = '<?php' . PHP_EOL .
            $indention . '//@todo implement';

        $this->assertEquals($expectedContent, $generator->generate());
    }

    public function testWithAll()
    {
        $classBar = $this->getClassGenerator();
        $classFoo = $this->getClassGenerator();
        $constantBar = $this->getConstantGenerator();
        $constantFoo = $this->getConstantGenerator();
        $content = array(
            '//@todo implement',
        );
        $generator = $this->getFileGenerator();
        $indention = $this->getIndention();
        $methodBar = $this->getMethodGenerator($generator->getIndention());
        $methodFoo = $this->getMethodGenerator($generator->getIndention());
        $propertyBar = $this->getPropertyGenerator();
        $propertyFoo = $this->getPropertyGenerator();

        $generator->addFileContent($content);
        $classBar->setName('bar');
        $classFoo->setName('foo');
        $constantBar->setName('BAR');
        $constantBar->setValue('foo');
        $constantFoo->setName('FOO');
        $constantFoo->setValue(42);
        $methodBar->setName('bar');
        $methodBar->markAsPublic();
        $methodFoo->setName('foo');
        $methodFoo->markAsProtected();
        $propertyBar->setName('bar');
        $propertyBar->markAsPublic();
        $propertyBar->setValue('\'foo\'');
        $propertyFoo->setName('foo');
        $propertyFoo->setValue('\'bar\'');
        $propertyFoo->markAsPrivate();

        $generator->addClass($classBar);
        $generator->addClass($classFoo);
        $generator->addConstant($constantBar);
        $generator->addConstant($constantFoo);
        $generator->addProperty($propertyBar);
        $generator->addProperty($propertyFoo);
        $generator->addMethod($methodBar);
        $generator->addMethod($methodFoo);
        $generator->markAsExecutable();

        $indention->increaseLevel();
        $doubledIndention = $indention->toString();
        $indention->decreaseLevel();

        $expectedContent = '#!/bin/php' . PHP_EOL .
            $indention . '<?php' . PHP_EOL .
            $indention . '//@todo implement' . PHP_EOL .
            $indention . PHP_EOL .
            $indention . 'const BAR = \'foo\';' . PHP_EOL .
            $indention . PHP_EOL .
            $indention . 'const FOO = 42;' . PHP_EOL .
            $indention . PHP_EOL .
            $indention . 'public $bar = \'foo\';' . PHP_EOL .
            $indention . PHP_EOL .
            $indention . 'private $foo = \'bar\';' . PHP_EOL .
            $indention . PHP_EOL .
            $indention . 'public function bar()' . PHP_EOL .
            $indention . '{' . PHP_EOL .
            $doubledIndention . '//@todo implement' . PHP_EOL .
            $indention . '}' . PHP_EOL .
            $indention . PHP_EOL .
            $indention . 'protected function foo()' . PHP_EOL .
            $indention . '{' . PHP_EOL .
            $doubledIndention . '//@todo implement' . PHP_EOL .
            $indention . '}' . PHP_EOL .
            $indention . PHP_EOL .
            $indention . 'class bar' . PHP_EOL .
            $indention . '{' . PHP_EOL .
            $indention . '}' . PHP_EOL .
            $indention . PHP_EOL .
            $indention . 'class foo' . PHP_EOL .
            $indention . '{' . PHP_EOL .
            $indention . '}';

        $this->assertEquals($expectedContent, $generator->generate());
    }
}