<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-01-06 
 */

namespace Test\Net\Bazzline\Component\CodeGenerator;

/**
 * Class SignatureGeneratorTest
 * @package Test\Net\Bazzline\Component\CodeGenerator
 */
class SignatureGeneratorTest extends GeneratorTestCase
{
    public function testWithConstants()
    {
        $generator      = $this->getSignatureGenerator();
        $constantBar    = $this->getConstantGenerator();
        $constantFoo    = $this->getConstantGenerator();

        $constantBar->setName('BAR');
        $constantBar->setValue('foo');
        $constantFoo->setName('FOO');
        $constantFoo->setValue(42);

        $generator->addConstant($constantBar);
        $generator->addConstant($constantFoo);
        $generator->setName('UnitTest');

        $indention = $this->getIndention();
        $indention->increaseLevel();
        $expectedString =
            'class UnitTest' . PHP_EOL .
            '{' . PHP_EOL .
            $indention . "const BAR = 'foo';" . PHP_EOL .
            '' . PHP_EOL .
            $indention . "const FOO = 42;" . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithMethods()
    {
        $generator  = $this->getSignatureGenerator();
        $methodOne  = $this->getMethodGenerator($generator->getIndention());
        $methodTwo  = $this->getMethodGenerator($generator->getIndention());

        $methodOne->setName('methodOne');
        $methodOne->markAsPrivate();
        $methodTwo->setName('methodTwo');
        $methodTwo->markAsProtected();

        $generator->addMethod($methodOne);
        $generator->addMethod($methodTwo);
        $generator->setName('UnitTest');

        $indention = $this->getIndention();
        $indention->increaseLevel();
        $expectedString =
            'class UnitTest' . PHP_EOL .
            '{' . PHP_EOL .
            $indention . 'private function methodOne()' . PHP_EOL .
            $indention . '{' . PHP_EOL .
            $indention . $indention . '//@todo implement' . PHP_EOL .
            $indention . '}' . PHP_EOL .
            '' . PHP_EOL .
            $indention . 'protected function methodTwo()' . PHP_EOL .
            $indention . '{' . PHP_EOL .
            $indention . $indention . '//@todo implement' . PHP_EOL .
            $indention . '}' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithUse()
    {
        $generator = $this->getSignatureGenerator();
        $generator->addUse('Bar\Foo', 'BarFoo');
        $generator->addUse('Foo\Bar', 'FooBar');
        $generator->setName('UnitTest');

        $expectedString =
            'use Bar\Foo as BarFoo;' . PHP_EOL .
            'use Foo\Bar as FooBar;' . PHP_EOL .
            '' . PHP_EOL .
            'class UnitTest' . PHP_EOL .
            '{' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }
}