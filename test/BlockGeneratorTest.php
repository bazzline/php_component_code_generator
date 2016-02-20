<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-26 
 */

namespace Test\Net\Bazzline\Component\CodeGenerator;

use Net\Bazzline\Component\CodeGenerator\BlockGenerator;
use Net\Bazzline\Component\CodeGenerator\LineGenerator;

/**
 * Class BlockGeneratorTest
 * @package Test\Net\Bazzline\Component\Locator\LocatorGenerator
 */
class BlockGeneratorTest extends GeneratorTestCase
{
    public function testWithoutContent()
    {
        $block = $this->getBlockGenerator();

        $this->assertFalse($block->hasContent());
        $this->assertEquals('', $block->generate());
    }

    public function testAddString()
    {
        $content = 'there is no foo without a bar';
        $block = $this->getBlockGenerator();
        $block->add($content);

        $this->assertTrue($block->hasContent());
        $this->assertEquals($content, $block->generate());
    }

    public function testAddStringWithIndention()
    {
        $content = 'there is no foo without a bar';
        $block = $this->getBlockGenerator();
        $block->add($content);
        $indention = $block->getIndention();
        $indention->increaseLevel();

        $this->assertTrue($block->hasContent());
        $this->assertEquals($indention . $content, $block->generate($indention));
    }

    public function testAddArray()
    {
        $content = 'there is no foo without a bar';
        $contentAsArray = explode(' ', $content);
        $expectedContent = implode(PHP_EOL, $contentAsArray);
        $block = $this->getBlockGenerator();
        $block->add($contentAsArray);

        $this->assertTrue($block->hasContent());
        $this->assertEquals($expectedContent, $block->generate());
    }

    public function testAddArrayWithIndention()
    {
        $content = 'there is no foo without a bar';
        $contentAsArray = explode(' ', $content);
        $block = $this->getBlockGenerator();
        $indention = $block->getIndention();
        $indention->increaseLevel();
        $expectedContent =
            $indention . 'there' . PHP_EOL .
            $indention . 'is' . PHP_EOL .
            $indention . 'no' . PHP_EOL .
            $indention . 'foo' . PHP_EOL .
            $indention . 'without' . PHP_EOL .
            $indention . 'a' . PHP_EOL .
            $indention . 'bar';
        $block->add($contentAsArray);

        $this->assertTrue($block->hasContent());
        $this->assertEquals($expectedContent, $block->generate());
    }

    public function testAddNestedArray()
    {
        $contentAsArray = array(
            array('there'),
            array('is'),
            array('no'),
            array('f', 'o', 'o'),
            array('without'),
            array('a'),
            array('b', 'a', 'r')
        );
        $expectedContent =
            'there' . PHP_EOL .
            'is' . PHP_EOL .
            'no' . PHP_EOL .
            'f' . PHP_EOL .
            'o' . PHP_EOL .
            'o' . PHP_EOL .
            'without' . PHP_EOL .
            'a' . PHP_EOL .
            'b' . PHP_EOL .
            'a' . PHP_EOL .
            'r';
        $block = $this->getBlockGenerator();
        $block->add($contentAsArray);

        $this->assertTrue($block->hasContent());
        $this->assertEquals($expectedContent, $block->generate());
    }

    public function testAddNestedArrayWithIndention()
    {
        $contentAsArray = array(
            array('there'),
            array('is'),
            array('no'),
            array('f', 'o', 'o'),
            array('without'),
            array('a'),
            array('b', 'a', 'r')
        );
        $block = $this->getBlockGenerator();
        $indention = $block->getIndention();
        $expectedContent =
            'there' . PHP_EOL .
            'is' . PHP_EOL .
            'no' . PHP_EOL .
            'f' . PHP_EOL .
            'o' . PHP_EOL .
            'o' . PHP_EOL .
            'without' . PHP_EOL .
            'a' . PHP_EOL .
            'b' . PHP_EOL .
            'a' . PHP_EOL .
            'r';
        $block->setIndention($indention);
        $block->add($contentAsArray);

        $this->assertTrue($block->hasContent());
        $this->assertEquals($expectedContent, $block->generate());
    }

    public function testAddLine()
    {
        $block = $this->getBlockGenerator();
        $indention = $block->getIndention();
        $content = new LineGenerator($indention, 'there is no foo without a bar');
        $block->add($content);

        $this->assertTrue($block->hasContent());
        $this->assertEquals($content, $block->generate());
    }

    public function testAddLineWithIndention()
    {
        $block = $this->getBlockGenerator();
        $indention = $block->getIndention();
        $indention->increaseLevel();
        $content = new LineGenerator($indention, 'there is no foo without a bar');
        $block->add($content);

        $this->assertTrue($block->hasContent());
        $this->assertEquals($content, $block->generate());
    }

    public function testAddBlock()
    {
        $block = $this->getBlockGenerator();
        $indention = $block->getIndention();
        $lineGenerator = $this->getLineGenerator();
        $lineGenerator->setIndention($indention);
        $content = new BlockGenerator($lineGenerator, $indention, 'there is no foo without a bar');
        $content->add('never ever');
        $block->add($content);

        $indention->increaseLevel();
        $expectedContent =
            $indention . 'there is no foo without a bar' . PHP_EOL .
            $indention . 'never ever';
        $indention->decreaseLevel();
        $this->assertTrue($block->hasContent());
        $this->assertEquals($expectedContent, $block->generate());
    }

    public function testAddBlockWithIndention()
    {
        $block = $this->getBlockGenerator();
        $indention = $block->getIndention();
        $lineGenerator = $this->getLineGenerator();
        $lineGenerator->setIndention($indention);
        $content = new BlockGenerator($lineGenerator, $indention, 'there is no foo without a bar');
        $content->add('never ever');
        $block->add($content);
        $indention->increaseLevel();

        $expectedContent =
            $indention . $indention . 'there is no foo without a bar' . PHP_EOL .
            $indention . $indention . 'never ever';
        $this->assertTrue($block->hasContent());
        $this->assertEquals($expectedContent, $block->generate());
    }

    public function testMultipleAdd()
    {
        $content = 'there is no foo without a bar';
        $contentAsArray = explode(' ', $content);
        $block = $this->getBlockGenerator();

        foreach ($contentAsArray as $part) {
            $block->add($part);
        }

        $this->assertTrue($block->hasContent());
        $this->assertEquals(implode(PHP_EOL, $contentAsArray), $block->generate());
    }

    public function testClear()
    {
        $content = 'there is no foo without a bar';
        $block = $this->getBlockGenerator();
        $block->add($content);
        $block->clear();

        $this->assertFalse($block->hasContent());
        $this->assertEquals('', $block->generate());
    }

    public function testClone()
    {
        $content = 'there is no foo without a bar';
        $block = $this->getBlockGenerator();
        $block->add($content);
        $anotherLine = clone $block;

        $this->assertTrue($block->hasContent());
        $this->assertEquals($content, $block->generate());
        $this->assertFalse($anotherLine->hasContent());
        $this->assertEquals('', $anotherLine->generate());
    }
}