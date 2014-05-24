<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-05-24 
 */

require_once 'AbstractExample.php';
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Class ParagraphExample
 * @package Net\Bazzline\Component\CodeGenerator\Example
 */
class ParagraphExample extends AbstractExample
{
    /**
     * @return string
     */
    function demonstrate()
    {
        $blockFactory = $this->getBlockGeneratorFactory();
        $block = $blockFactory->create();

        $block->add('first line');
        $block->add('second line');
        $block->add('last line');

        echo $block->generate() . PHP_EOL;
    }
}

$example = new ParagraphExample();
$example->demonstrate();