<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-01-04 
 */

namespace Test\Net\Bazzline\Component\CodeGenerator;

/**
 * Class InterfaceGeneratorTest
 * @package Test\Net\Bazzline\Component\CodeGenerator
 */
class InterfaceGeneratorTest extends GeneratorTestCase
{
    public function testWithNoProperties()
    {
        $generator = $this->getInterfaceGenerator();
        $this->assertEquals('', $generator->generate());
    }

    public function testWithoutExtends()
    {
        $generator = $this->getInterfaceGenerator();
        $generator->setName('UnitTest');

        $expectedString =
            'interface UnitTest' . PHP_EOL .
            '{' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithSingleExtends()
    {
        $generator = $this->getInterfaceGenerator();
        $generator->addExtends('\BarInterface');
        $generator->setName('UnitTest');

        $expectedString =
            'interface UnitTest extends \BarInterface' . PHP_EOL .
            '{' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithMultipleExtends()
    {
        $generator = $this->getInterfaceGenerator();
        $generator->addExtends('\BarInterface');
        $generator->addExtends('\FooInterface');
        $generator->addExtends('\FooBarInterface');
        $generator->setName('UnitTest');

        $expectedString =
            'interface UnitTest extends \BarInterface, \FooInterface, \FooBarInterface' . PHP_EOL .
            '{' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }
}