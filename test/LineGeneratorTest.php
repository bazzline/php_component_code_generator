<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-26 
 */

namespace Test\Net\Bazzline\Component\CodeGenerator;

/**
 * Class LineGeneratorTest
 * @package Test\Net\Bazzline\Component\Locator\LocatorGenerator
 */
class LineGeneratorTest extends GeneratorTestCase
{
    public function testWithoutContent()
    {
        $line = $this->getLineGenerator();

        $this->assertFalse($line->hasContent());
        $this->assertEquals('', $line->generate());
    }

    public function testToString()
    {
        $content = 'there is no foo without a bar';
        $indention = $this->getIndention();
        $line = $this->getLineGenerator();

        $line->setIndention($indention);
        $line->add($content);

        $this->assertTrue($line->hasContent());
        $this->assertEquals($content, (string) $line);
    }

    public function testAdd()
    {
        $content = 'there is no foo without a bar';
        $indention = $this->getIndention();
        $line = $this->getLineGenerator();

        $line->setIndention($indention);
        $line->add($content);

        $this->assertTrue($line->hasContent());
        $this->assertEquals($content, $line->generate());
    }

    public function testAddArray()
    {
        $content = 'there is no foo without a bar';
        $contentAsArray = explode(' ', $content);
        $indention = $this->getIndention();
        $line = $this->getLineGenerator();

        $line->setIndention($indention);
        $line->add($contentAsArray);

        $this->assertTrue($line->hasContent());
        $this->assertEquals($content, $line->generate());
    }

    public function testAddNestedArray()
    {
        $contentAsArray = [
            ['there'],
            ['is'],
            ['no'],
            ['f', 'o', 'o'],
            ['without'],
            ['a'],
            ['b', 'a', 'r']
        ];
        $expectedContent = 'there is no f o o without a b a r';
        $indention = $this->getIndention();
        $line = $this->getLineGenerator();

        $line->setIndention($indention);
        $line->add($contentAsArray);

        $this->assertTrue($line->hasContent());
        $this->assertEquals($expectedContent, $line->generate());
    }

    public function testMultipleAdd()
    {
        $content = 'there is no foo without a bar';
        $contentAsArray = explode(' ', $content);
        $indention = $this->getIndention();

        $line = $this->getLineGenerator();
        $line->setIndention($indention);

        foreach ($contentAsArray as $part) {
            $line->add($part);
        }

        $this->assertTrue($line->hasContent());
        $this->assertEquals($content, $line->generate());
    }

    public function testMultipleAddWithSeparator()
    {
        $content = 'there:is:no:foo:without:a:bar';
        $contentAsArray = explode(':', $content);
        $indention = $this->getIndention();
        $line = $this->getLineGenerator();

        $line->setIndention($indention);
        $line->setSeparator(':');

        foreach ($contentAsArray as $part) {
            $line->add($part);
        }

        $this->assertTrue($line->hasContent());
        $this->assertEquals($content, $line->generate());
    }

    public function testAddLine()
    {
        $content = 'there is no foo without a bar';
        $indention = $this->getIndention();
        $contentLine = $this->getLineGenerator();

        $contentLine->setIndention($indention);
        $contentLine->add($content);

        $line = $this->getLineGenerator();

        $line->setIndention($indention);
        $line->add($contentLine);

        $this->assertTrue($line->hasContent());
        $this->assertEquals($content, $line->generate());
    }

    public function testClear()
    {
        $content = 'there is no foo without a bar';
        $indention = $this->getIndention();
        $line = $this->getLineGenerator();

        $line->setIndention($indention);
        $line->add($content);

        $line->clear();

        $this->assertFalse($line->hasContent());
        $this->assertEquals('', $line->generate());
    }

    public function testClone()
    {
        $content = 'there is no foo without a bar';
        $indention = $this->getIndention();
        $line = $this->getLineGenerator();

        $line->setIndention($indention);
        $line->add($content);

        $anotherLine = clone $line;

        $this->assertTrue($line->hasContent());
        $this->assertEquals($content, $line->generate());
        $this->assertFalse($anotherLine->hasContent());
        $this->assertEquals('', $anotherLine->generate());
    }
}
