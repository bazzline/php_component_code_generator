<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-24 
 */

namespace Test\Net\Bazzline\Component\CodeGenerator;

/**
 * Class DocumentationGeneratorTest
 * @package Test\Net\Bazzline\Component\Locator\LocatorGenerator\Generator
 */
class DocumentationGeneratorTest extends GeneratorTestCase
{
    public function testWithNoProperties()
    {
        $generator = $this->getDocumentationGenerator();

        $expectedString = '';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithNoPropertiesAndPrefix()
    {
        $generator = $this->getDocumentationGenerator();

        $this->assertEquals('', $generator->generate());
    }

    public function testWithComments()
    {
        $generator = $this->getDocumentationGenerator();
        $generator->addComment('Foo');
        $generator->addComment('Bar');

        $expectedString =
            '/**' . PHP_EOL .
            ' * Foo' . PHP_EOL .
            ' * Bar' . PHP_EOL .
            ' */';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithClass()
    {
        $generator = $this->getDocumentationGenerator();
        $generator->setClass('UnitTest');

        $expectedString =
            '/**' . PHP_EOL .
            ' * Class UnitTest' .  PHP_EOL .
            ' */';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithPackage()
    {
        $generator = $this->getDocumentationGenerator();
        $generator->setPackage('Unit\Test');

        $expectedString =
            '/**' . PHP_EOL .
            ' * @package Unit\Test' .  PHP_EOL .
            ' */';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithParameters()
    {
        $generator = $this->getDocumentationGenerator();
        $generator->addParameter('bar', array('Bar'));
        $generator->addParameter('foo', array('Foo'));
        $generator->addParameter('fooBar', array('Foo', 'Bar'), 'there is no foo without a bar');

        $expectedString =
            '/**' . PHP_EOL .
            ' * @param Bar $bar' . PHP_EOL .
            ' * @param Foo $foo' . PHP_EOL .
            ' * @param Foo|Bar $fooBar there is no foo without a bar' . PHP_EOL .
            ' */';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithReturn()
    {
        $generator = $this->getDocumentationGenerator();
        $generator->setReturn(array('Foo', 'Bar'), 'there is no foo without a bar');

        $expectedString =
            '/**' . PHP_EOL .
            ' * @return Foo|Bar there is no foo without a bar' . PHP_EOL .
            ' */';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithSees()
    {
        $generator = $this->getDocumentationGenerator();
        $generator->addSee('https://artodeto@bazzline.net');
        $generator->addSee('https://github.com/stevleibelt');

        $expectedString =
            '/**' . PHP_EOL .
            ' * @see https://artodeto@bazzline.net' . PHP_EOL .
            ' * @see https://github.com/stevleibelt' . PHP_EOL .
            ' */';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithThrows()
    {
        $generator = $this->getDocumentationGenerator();
        $generator->addThrows('BarException');
        $generator->addThrows('FooException');

        $expectedString =
            '/**' . PHP_EOL .
            ' * @throws BarException|FooException' . PHP_EOL .
            ' */';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithToDos()
    {
        $generator = $this->getDocumentationGenerator();
        $generator->addTodoS('implement bar exception');
        $generator->addTodoS('implement foo exception');

        $expectedString =
            '/**' . PHP_EOL .
            ' * @todo implement bar exception' . PHP_EOL .
            ' * @todo implement foo exception' . PHP_EOL .
            ' */';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithVariable()
    {
        $generator = $this->getDocumentationGenerator();
        $generator->setVariable('foobar', array('Bar', 'Foo'));

        $expectedString =
            '/**' . PHP_EOL .
            ' * @var Bar|Foo $foobar' . PHP_EOL .
            ' */';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithAll()
    {
        $generator = $this->getDocumentationGenerator();
        $generator->addComment('Foo');
        $generator->addComment('Bar');
        $generator->setClass('UnitTest');
        $generator->setPackage('Unit\Test');
        $generator->addParameter('bar', array('Bar'));
        $generator->addParameter('foo', array('Foo'));
        $generator->addParameter('fooBar', array('Foo', 'Bar'), 'there is no foo without a bar');
        $generator->setReturn(array('Foo', 'Bar'), 'there is no foo without a bar');
        $generator->addSee('https://artodeto@bazzline.net');
        $generator->addSee('https://github.com/stevleibelt');
        $generator->addThrows('BarException');
        $generator->addThrows('FooException');
        $generator->addTodoS('implement bar exception');
        $generator->addTodoS('implement foo exception');
        $generator->setVariable('foobar', array('Bar', 'Foo'));

        $expectedString =
            '/**' . PHP_EOL .
            ' * @see https://artodeto@bazzline.net' . PHP_EOL .
            ' * @see https://github.com/stevleibelt' . PHP_EOL .
            ' * Foo' . PHP_EOL .
            ' * Bar' . PHP_EOL .
            ' * Class UnitTest' .  PHP_EOL .
            ' *' . PHP_EOL .
            ' * @package Unit\Test' .  PHP_EOL .
            ' * @todo implement bar exception' . PHP_EOL .
            ' * @todo implement foo exception' . PHP_EOL .
            ' * @param Bar $bar' . PHP_EOL .
            ' * @param Foo $foo' . PHP_EOL .
            ' * @param Foo|Bar $fooBar there is no foo without a bar' . PHP_EOL .
            ' * @return Foo|Bar there is no foo without a bar' . PHP_EOL .
            ' * @throws BarException|FooException' . PHP_EOL .
            ' * @var Bar|Foo $foobar' . PHP_EOL .
            ' */';

        $this->assertEquals($expectedString, $generator->generate());
    }
}