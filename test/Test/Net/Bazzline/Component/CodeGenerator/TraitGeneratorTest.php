<?php
/**
 * @author sleibelt
 * @since 2014-04-28
 */

namespace Test\Net\Bazzline\Component\CodeGenerator;

/**
 * Class TraitGeneratorTest
 * @package Test\Net\Bazzline\Component\Locator\LocatorGenerator\Generator
 */
class TraitGeneratorTest extends GeneratorTestCase
{
    public function testWithNoProperties()
    {
        $generator = $this->getTraitGenerator();
        $this->assertEquals('', $generator->generate());
    }

    public function testWithName()
    {
        $generator = $this->getTraitGenerator();
        $generator->setName('UnitTest');

        $expectedString =
            'trait UnitTest' . PHP_EOL .
            '{' . PHP_EOL .
            '}';

        $this->assertEquals('UnitTest', $generator->getName());
        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithConstants()
    {
        $generator      = $this->getTraitGenerator();
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
            'trait UnitTest' . PHP_EOL .
            '{' . PHP_EOL .
            $indention . 'const BAR = \'foo\';' . PHP_EOL .
            '' . PHP_EOL .
            $indention . 'const FOO = 42;' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithProperties()
    {
        $generator      = $this->getTraitGenerator();
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
            'trait UnitTest' . PHP_EOL .
            '{' . PHP_EOL .
            $indention . 'private $bar = 23;' . PHP_EOL .
            '' . PHP_EOL .
            $indention . 'protected $foo = 42;' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithMethods()
    {
        $generator      = $this->getTraitGenerator();
        $methodOne      = $this->getMethodGenerator($generator->getIndention());
        $methodTwo      = $this->getMethodGenerator($generator->getIndention());

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
            'trait UnitTest' . PHP_EOL .
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

    public function testWithEmptyDocumentation()
    {
        $documentation  = $this->getDocumentationGenerator();
        $generator      = $this->getTraitGenerator();

        $generator->setDocumentation($documentation);
        $generator->setName('UnitTest');

        $expectedString =
            '/**' . PHP_EOL .
            ' * Class UnitTest' . PHP_EOL .
            ' */' . PHP_EOL .
            'trait UnitTest' . PHP_EOL .
            '{' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
        $this->assertSame($documentation, $generator->getDocumentation());
    }

    public function testWithManualDocumentation()
    {
        $documentation  = $this->getDocumentationGenerator();
        $generator      = $this->getTraitGenerator();

        $documentation->setClass('UnitTest');
        $documentation->setPackage('Foo\Bar');

        $generator->setDocumentation($documentation, false);
        $generator->setName('UnitTest');

        $expectedString =
            '/**' . PHP_EOL .
            ' * Class UnitTest' . PHP_EOL .
            ' *' . PHP_EOL .
            ' * @package Foo\Bar' . PHP_EOL .
            ' */' . PHP_EOL .
            'trait UnitTest' . PHP_EOL .
            '{' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
        $this->assertSame($documentation, $generator->getDocumentation());
    }

    public function testWithAll()
    {
        $constantBar    = $this->getConstantGenerator();
        $constantFoo    = $this->getConstantGenerator();
        $documentation  = $this->getDocumentationGenerator();
        $generator      = $this->getTraitGenerator();
        $methodOne      = $this->getMethodGenerator($generator->getIndention());
        $methodTwo      = $this->getMethodGenerator($generator->getIndention());
        $propertyBar    = $this->getPropertyGenerator();
        $propertyFoo    = $this->getPropertyGenerator();

        $constantBar->setName('BAR');
        $constantBar->setValue('foo');
        $constantFoo->setName('FOO');
        $constantFoo->setValue(42);
        $documentation->setClass('UnitTest');
        $documentation->setPackage('Foo\Bar');
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
        $generator->addMethod($methodOne);
        $generator->addMethod($methodTwo);
        $generator->addProperty($propertyBar);
        $generator->addProperty($propertyFoo);
        $generator->setDocumentation($documentation);
        $generator->setName('UnitTest');

        $indention = $this->getIndention();
        $indention->increaseLevel();
        $expectedString =
            '/**' . PHP_EOL .
            ' * Class UnitTest' . PHP_EOL .
            ' *' . PHP_EOL .
            ' * @package Foo\Bar' . PHP_EOL .
            ' */' . PHP_EOL .
            'trait UnitTest' . PHP_EOL .
            '{' . PHP_EOL .
            $indention . 'const BAR = \'foo\';' . PHP_EOL .
            '' . PHP_EOL .
            $indention . 'const FOO = 42;' . PHP_EOL .
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