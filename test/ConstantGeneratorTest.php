<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-27 
 */

namespace Test\Net\Bazzline\Component\CodeGenerator;

/**
 * Class ConstantGeneratorTest
 * @package Test\Net\Bazzline\Component\Locator\LocatorGenerator\Generator
 */
class ConstantGeneratorTest extends GeneratorTestCase
{
    public function testWithNoProperties()
    {
        $generator = $this->getConstantGenerator();
        $this->assertEquals('', $generator->generate());
    }

    public function testWithNameAndValue()
    {
        $generator = $this->getConstantGenerator();
        $generator->setName('UNIT_TEST');
        $generator->setValue('foobar');

        $expectedString = 'const UNIT_TEST = \'foobar\';';

        $this->assertEquals($expectedString, $generator->generate());
    }
}