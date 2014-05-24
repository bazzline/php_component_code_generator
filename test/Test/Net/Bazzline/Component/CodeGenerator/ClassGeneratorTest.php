<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-27 
 */

namespace Test\Net\Bazzline\Component\CodeGenerator;

/**
 * Class ClassGeneratorTest
 * @package Test\Net\Bazzline\Component\Locator\LocatorGenerator\Generator
 */
class ClassGeneratorTest extends GeneratorTestCase
{
    public function testWithNoProperties()
    {
        $generator = $this->getClassGenerator();
        $this->assertEquals('', $generator->generate());
    }

    public function testAsAbstract()
    {
        $generator = $this->getClassGenerator();
        $generator->markAsAbstract();
        $generator->setName('UnitTest');

        $expectedString =
            'abstract class UnitTest' . PHP_EOL .
            '{' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testAsInterface()
    {
        $generator = $this->getClassGenerator();
        $generator->markAsInterface();
        $generator->setName('UnitTest');

        $expectedString =
            'interface class UnitTest' . PHP_EOL .
            '{' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testAsFinal()
    {
        $generator = $this->getClassGenerator();
        $generator->markAsFinal();
        $generator->setName('UnitTest');

        $expectedString =
            'final class UnitTest' . PHP_EOL .
            '{' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithExtends()
    {
        $generator = $this->getClassGenerator();
        $generator->addExtends('\Bar\Foo');
        $generator->addExtends('\Foo\Bar');
        $generator->setName('UnitTest');

        $expectedString =
            'class UnitTest extends \Bar\Foo,\Foo\Bar' . PHP_EOL .
            '{' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithImplements()
    {
        $generator = $this->getClassGenerator();
        $generator->addImplements('\Bar\Foo');
        $generator->addImplements('\Foo\Bar');
        $generator->setName('UnitTest');

        $expectedString =
            'class UnitTest implements \Bar\Foo, \Foo\Bar' . PHP_EOL .
            '{' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithUse()
    {
        $generator = $this->getClassGenerator();
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

    public function testWithConstants()
    {
        $generator      = $this->getClassGenerator();
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

    public function testWithProperties()
    {
        $generator      = $this->getClassGenerator();
        $propertyBar    = $this->getPropertyGenerator();
        $propertyFoo    = $this->getPropertyGenerator();

        $propertyBar->setName('bar');
        $propertyBar->setValue(23);
        $propertyBar->markAsPrivate();
        $propertyFoo->setName('foo');
        $propertyFoo->setValue(42);
        $propertyFoo->markAsProtected();

        $generator->addProperty($propertyBar);
        $generator->addProperty($propertyFoo);
        $generator->setName('UnitTest');

        $indention = $this->getIndention();
        $indention->increaseLevel();
        $expectedString =
            'class UnitTest' . PHP_EOL .
            '{' . PHP_EOL .
            $indention . 'private $bar = 23;' . PHP_EOL .
            '' . PHP_EOL .
            $indention . 'protected $foo = 42;' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithMethods()
    {
        $generator  = $this->getClassGenerator();
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

    public function testWithTraits()
    {
        $generator  = $this->getClassGenerator();
        $traitOne   = $this->getTraitGenerator();
        $traitTwo   = $this->getTraitGenerator();

        $traitOne->setName('TraitOne');
        $traitTwo->setName('TraitTwo');

        $generator->addTrait($traitOne);
        $generator->addTrait($traitTwo);
        $generator->setName('UnitTest');

        $indention = $this->getIndention();
        $indention->increaseLevel();
        $expectedString =
            'class UnitTest' . PHP_EOL .
            '{' . PHP_EOL .
            $indention . 'use TraitOne,TraitTwo;' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithDocumentation()
    {
        $documentation  = $this->getDocumentationGenerator();
        $generator      = $this->getClassGenerator();

        $documentation->setClass('UnitTest');
        $documentation->setPackage('Foo\Bar');

        $generator->setDocumentation($documentation);
        $generator->setNamespace('Foo\Bar');
        $generator->setName('UnitTest');

        $expectedString =
            'namespace Foo\Bar;' . PHP_EOL .
            '' . PHP_EOL .
            '/**' . PHP_EOL .
            ' * Class UnitTest' . PHP_EOL .
            ' *' . PHP_EOL .
            ' * @package Foo\Bar' . PHP_EOL .
            ' */' . PHP_EOL .
            'class UnitTest' . PHP_EOL .
            '{' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
        $this->assertSame($documentation, $generator->getDocumentation());
    }

    public function testWithNamespace()
    {
        $generator = $this->getClassGenerator();

        $generator->setNamespace('Foo\Bar');
        $generator->setName('UnitTest');

        $expectedString =
            'namespace Foo\Bar;' . PHP_EOL .
            '' . PHP_EOL .
            'class UnitTest' . PHP_EOL .
            '{' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithALot()
    {
        $documentation  = $this->getDocumentationGenerator();
        $constantBar    = $this->getConstantGenerator();
        $constantFoo    = $this->getConstantGenerator();
        $generator      = $this->getClassGenerator();
        $methodOne      = $this->getMethodGenerator($generator->getIndention());
        $methodTwo      = $this->getMethodGenerator($generator->getIndention());
        $propertyBar    = $this->getPropertyGenerator();
        $propertyFoo    = $this->getPropertyGenerator();

        $constantBar->setName('BAR');
        $constantBar->setValue('foo');
        $constantFoo->setName('FOO');
        $constantFoo->setValue(42);

        $methodOne->setName('methodOne');
        $methodOne->markAsPrivate();
        $methodTwo->setName('methodTwo');
        $methodTwo->markAsProtected();
        $propertyBar->setName('bar');
        $propertyBar->setValue(23);
        $propertyBar->markAsPrivate();
        $propertyFoo->setName('foo');
        $propertyFoo->setValue(42);
        $propertyFoo->markAsProtected();

        $generator->addConstant($constantBar);
        $generator->addConstant($constantFoo);
        $generator->addProperty($propertyBar);
        $generator->addProperty($propertyFoo);
        $generator->addExtends('BarFoo');
        $generator->addExtends('FooBar');
        $generator->addImplements('BarFooInterface');
        $generator->addImplements('FooBarInterface');
        $generator->addMethod($methodOne);
        $generator->addMethod($methodTwo);
        $generator->addUse('Bar\Foo', 'BarFoo');
        $generator->addUse('BarFoo\BarFooInterface');
        $generator->addUse('Foo\Bar', 'FooBar');
        $generator->addUse('FooBar\FooBarInterface');
        $generator->setDocumentation($documentation);
        $generator->setName('UnitTest');
        $generator->setNamespace('Baz');

        $indention = $this->getIndention();
        $indention->increaseLevel();
        $expectedString =
            'namespace Baz;' . PHP_EOL .
            '' . PHP_EOL .
            'use Bar\Foo as BarFoo;' . PHP_EOL .
            'use BarFoo\BarFooInterface;' . PHP_EOL .
            'use Foo\Bar as FooBar;' . PHP_EOL .
            'use FooBar\FooBarInterface;' . PHP_EOL .
            '' . PHP_EOL .
            '/**' . PHP_EOL .
            ' * Class UnitTest' . PHP_EOL .
            ' *' . PHP_EOL .
            ' * @package Baz' . PHP_EOL .
            ' */' . PHP_EOL .
            'class UnitTest extends BarFoo,FooBar implements BarFooInterface, FooBarInterface' . PHP_EOL .
            '{' . PHP_EOL .
            $indention . "const BAR = 'foo';" . PHP_EOL .
            '' . PHP_EOL .
            $indention . "const FOO = 42;" . PHP_EOL .
            '' . PHP_EOL .
            $indention . 'private $bar = 23;' . PHP_EOL .
            '' . PHP_EOL .
            $indention . 'protected $foo = 42;' . PHP_EOL .
            '' . PHP_EOL .
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
}
