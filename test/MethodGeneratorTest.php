<?php
/**
 * @author sleibelt
 * @since 2014-04-25
 */

namespace Test\Net\Bazzline\Component\CodeGenerator;

/**
 * Class MethodGeneratorTest
 * @package Test\Net\Bazzline\Component\Locator\LocatorGenerator\Generator
 */
class MethodGeneratorTest extends GeneratorTestCase
{
    public function testWithNoProperties()
    {
        $generator = $this->getMethodGenerator();
        $generator->setName('unittest');

        $indention = $this->getIndention();
        $indention->increaseLevel();
        $expectedString =
            'function unittest()' . PHP_EOL .
            '{' . PHP_EOL .
            $indention . '//@todo implement' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithNoPropertiesAndNotDefaultIndention()
    {
        $indention = $this->getIndention();
        $indention->setString('>-(0_o)-<');
        $generator = $this->getMethodGenerator($indention);
        $generator->setName('unittest');

        $indention->increaseLevel();
        $expectedString =
            'function unittest()' . PHP_EOL .
            '{' . PHP_EOL .
            $indention . '//@todo implement' . PHP_EOL .
            '}';
        $indention->decreaseLevel();

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testMarkAsAbstract()
    {
        $generator = $this->getMethodGenerator();
        $generator->markAsAbstract();
        $generator->setName('unittest');

        $expectedString = 'abstract function unittest();';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testMarkAsHasNoBody()
    {
        $generator = $this->getMethodGenerator();
        $generator->markAsHasNoBody();
        $generator->setName('unittest');

        $expectedString = 'function unittest();';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithBody()
    {
        $body = [
            '$bar = new Bar();',
            '$foo = new Foo();',
            '$foobar->add($bar);',
            '$foobar->add($foo);',
            '',
            'return $foobar'
        ];

        $generator = $this->getMethodGenerator();
        $generator->setName('unittest');
        $generator->setBody($body);

        $indention = $this->getIndention();
        $indention->increaseLevel();
        $expectedString =
            'function unittest()' . PHP_EOL .
            '{' . PHP_EOL .
            $indention . '$bar = new Bar();' . PHP_EOL .
            $indention . '$foo = new Foo();' . PHP_EOL .
            $indention . '$foobar->add($bar);' . PHP_EOL .
            $indention . '$foobar->add($foo);' . PHP_EOL .
            '' . PHP_EOL .
            $indention . 'return $foobar' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testMarkAsFinal()
    {
        $generator = $this->getMethodGenerator();
        $generator->markAsFinal();
        $generator->setName('unittest');

        $indention = $this->getIndention();
        $indention->increaseLevel();
        $expectedString =
            'final function unittest()' . PHP_EOL .
            '{' . PHP_EOL .
            $indention . '//@todo implement' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testMarkAsPrivate()
    {
        $generator = $this->getMethodGenerator();
        $generator->markAsPrivate();
        $generator->setName('unittest');

        $indention = $this->getIndention();
        $indention->increaseLevel();
        $expectedString =
            'private function unittest()' . PHP_EOL .
            '{' . PHP_EOL .
            $indention . '//@todo implement' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testMarkAsProtected()
    {
        $generator = $this->getMethodGenerator();
        $generator->markAsProtected();
        $generator->setName('unittest');

        $indention = $this->getIndention();
        $indention->increaseLevel();
        $expectedString =
            'protected function unittest()' . PHP_EOL .
            '{' . PHP_EOL .
            $indention . '//@todo implement' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testMarkAsPublic()
    {
        $generator = $this->getMethodGenerator();
        $generator->setName('unittest');
        $generator->markAsPublic();

        $indention = $this->getIndention();
        $indention->increaseLevel();
        $expectedString =
            'public function unittest()' . PHP_EOL .
            '{' . PHP_EOL .
            $indention . '//@todo implement' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testMarkAsStatic()
    {
        $generator = $this->getMethodGenerator();
        $generator->setName('unittest');
        $generator->markAsPublic();
        $generator->markAsStatic();

        $indention = $this->getIndention();
        $indention->increaseLevel();
        $expectedString =
            'public static function unittest()' . PHP_EOL .
            '{' . PHP_EOL .
            $indention . '//@todo implement' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithAutoDocumentation()
    {
        $documentation  = $this->getDocumentationGenerator();
        $generator      = $this->getMethodGenerator();

        $generator->setDocumentation($documentation);
        $generator->addParameter('foo', '', 'string');
        $generator->setName('unittest');
        $generator->markAsPublic();

        $indention = $this->getIndention();
        $indention->increaseLevel();
        $expectedString =
            '/**' . PHP_EOL .
            ' * @param string $foo' . PHP_EOL .
            ' */' . PHP_EOL .
            'public function unittest($foo)' . PHP_EOL .
            '{' . PHP_EOL .
            $indention . '//@todo implement' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
        $this->assertSame($documentation, $generator->getDocumentation());
    }

    public function testWithAutoDocumentationAndBody()
    {
        $documentation  = $this->getDocumentationGenerator();
        $generator      = $this->getMethodGenerator();

        $generator->setDocumentation($documentation);
        $generator->addParameter('foo', '', 'string');
        $generator->setName('unittest');
        $generator->markAsPublic();
        $generator->setBody(
            [
                'return int($foo);'
            ], 
            [
                'int'
            ]
        );

        $indention = $this->getIndention();
        $indention->increaseLevel();
        $expectedString =
            '/**' . PHP_EOL .
            ' * @param string $foo' . PHP_EOL .
            ' * @return int' . PHP_EOL .
            ' */' . PHP_EOL .
            'public function unittest($foo)' . PHP_EOL .
            '{' . PHP_EOL .
            $indention . 'return int($foo);' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
        $this->assertSame($documentation, $generator->getDocumentation());
    }

    public function testWithManualDocumentation()
    {
        $documentation  = $this->getDocumentationGenerator();
        $generator      = $this->getMethodGenerator();

        $documentation->addParameter('foo', 'string');

        $generator->setDocumentation($documentation, false);
        $generator->addParameter('foo');
        $generator->setName('unittest');
        $generator->markAsPublic();

        $indention = $this->getIndention();
        $indention->increaseLevel();
        $expectedString =
            '/**' . PHP_EOL .
            ' * @param string $foo' . PHP_EOL .
            ' */' . PHP_EOL .
            'public function unittest($foo)' . PHP_EOL .
            '{' . PHP_EOL .
            $indention . '//@todo implement' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
        $this->assertSame($documentation, $generator->getDocumentation());
    }

    public function testWithALot()
    {
        $body = [
            '$bar = new Bar();',
            '$foo = new Foo();',
            '$foobar->add($bar);',
            '$foobar->add($foo);',
            '',
            'return $foobar'
        ];

        $generator = $this->getMethodGenerator();
        $generator->setBody($body);
        $generator->setName('unittest');
        $generator->markAsFinal();
        $generator->markAsPublic();

        $indention = $this->getIndention();
        $indention->increaseLevel();
        $expectedString =
            'final public function unittest()' . PHP_EOL .
            '{' . PHP_EOL .
            $indention . '$bar = new Bar();' . PHP_EOL .
            $indention . '$foo = new Foo();' . PHP_EOL .
            $indention . '$foobar->add($bar);' . PHP_EOL .
            $indention . '$foobar->add($foo);' . PHP_EOL .
            '' . PHP_EOL .
            $indention . 'return $foobar' . PHP_EOL .
            '}';

        $this->assertEquals($expectedString, $generator->generate());
    }
}
