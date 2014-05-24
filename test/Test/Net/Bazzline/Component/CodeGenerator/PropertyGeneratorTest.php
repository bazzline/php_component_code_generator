<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-27 
 */

namespace Test\Net\Bazzline\Component\CodeGenerator;

/**
 * Class PropertyGeneratorTest
 * @package Test\Net\Bazzline\Component\Locator\LocatorGenerator\Generator
 */
class PropertyGeneratorTest extends GeneratorTestCase
{
    /**
     * @expectedException \Net\Bazzline\Component\CodeGenerator\RuntimeException
     * @expectedExceptionMessage name is mandatory
     */
    public function testWithNoProperties()
    {
        $generator = $this->getPropertyGenerator();
        $generator->generate();
    }

    public function testWithName()
    {
        $generator = $this->getPropertyGenerator();

        $generator->setName('unitTest');

        $expectedString = '$unitTest;';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithNameAndValue()
    {
        $generator = $this->getPropertyGenerator();

        $generator->setName('unitTest');
        $generator->setValue('\'foobar\'');

        $expectedString = '$unitTest = \'foobar\';';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithStatic()
    {
        $generator = $this->getPropertyGenerator();

        $generator->markAsStatic();
        $generator->setName('unitTest');
        $generator->setValue('\'foobar\'');

        $expectedString = 'static $unitTest = \'foobar\';';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithPrivate()
    {
        $generator = $this->getPropertyGenerator();

        $generator->markAsPrivate();
        $generator->setName('unitTest');
        $generator->setValue('\'foobar\'');

        $expectedString = 'private $unitTest = \'foobar\';';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithProtected()
    {
        $generator = $this->getPropertyGenerator();

        $generator->markAsProtected();
        $generator->setName('unitTest');
        $generator->setValue('\'foobar\'');

        $expectedString = 'protected $unitTest = \'foobar\';';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithPublic()
    {
        $generator = $this->getPropertyGenerator();

        $generator->markAsPublic();
        $generator->setName('unitTest');
        $generator->setValue('\'foobar\'');

        $expectedString = 'public $unitTest = \'foobar\';';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithManuallyDocumentation()
    {
        $documentation = $this->getDocumentationGenerator();
        $documentation->setVariable('unitTest', array('string'));
        $generator = $this->getPropertyGenerator();

        $generator->setDocumentation($documentation, false);
        $generator->markAsPublic();
        $generator->setName('unitTest');
        $generator->setValue('\'foobar\'');

        $expectedString =
            '/**' . PHP_EOL .
            ' * @var string $unitTest' . PHP_EOL .
            ' */' . PHP_EOL .
            'public $unitTest = \'foobar\';';

        $this->assertEquals($expectedString, $generator->generate());
        $this->assertSame($documentation, $generator->getDocumentation());
    }

    public function testWithDocumentation()
    {
        $documentation = $this->getDocumentationGenerator();
        $generator = $this->getPropertyGenerator();

        $generator->setDocumentation($documentation);
        $generator->markAsPublic();
        $generator->setName('unitTest');
        $generator->setValue('\'foobar\'');

        $expectedString =
            '/**' . PHP_EOL .
            ' * @var $unitTest' . PHP_EOL .
            ' */' . PHP_EOL .
            'public $unitTest = \'foobar\';';

        $this->assertEquals($expectedString, $generator->generate());
        $this->assertSame($documentation, $generator->getDocumentation());
    }

    public function testWithDocumentationAndTypeHint()
    {
        $documentation = $this->getDocumentationGenerator();
        $generator = $this->getPropertyGenerator();

        $generator->setDocumentation($documentation);
        $generator->markAsPublic();
        $generator->addTypeHint('array');
        $generator->setName('unitTest');
        $generator->setValue('array(1,2)');

        $expectedString =
            '/**' . PHP_EOL .
            ' * @var array $unitTest' . PHP_EOL .
            ' */' . PHP_EOL .
            'public $unitTest = array(1,2);';

        $this->assertEquals($expectedString, $generator->generate());
    }

    public function testWithAll()
    {
        $documentation = $this->getDocumentationGenerator();
        $generator = $this->getPropertyGenerator();

        $generator->markAsPublic();
        $generator->setDocumentation($documentation);
        $generator->setName('unitTest');
        $generator->addTypeHint('string');
        $generator->addTypeHint('Test');
        $generator->addTypeHint('Unit');
        $generator->setValue('\'foobar\'');

        $expectedString =
            '/**' . PHP_EOL .
            ' * @var string|Test|Unit $unitTest' . PHP_EOL .
            ' */' . PHP_EOL .
            'public $unitTest = \'foobar\';';

        $this->assertEquals($expectedString, $generator->generate());
    }
} 