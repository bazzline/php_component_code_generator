<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-05-24 
 */

require_once 'AbstractExample.php';
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Class MethodExample
 * @package Net\Bazzline\Component\CodeGenerator\Example
 */
class MethodExample extends AbstractExample
{
    /**
     * @return string
     */
    function demonstrate()
    {
        $blockFactory           = $this->getBlockGeneratorFactory();
        $documentationFactory   = $this->getDocumentationGeneratorFactory();
        $methodFactory          = $this->getMethodGeneratorFactory();

        $myMethod = $methodFactory->create();
        $myMethod->setDocumentation($documentationFactory->create());
        $myMethod->markAsPublic();
        $myMethod->markAsFinal();
        $myMethod->setName('myMethod');
        $myMethod->addParameter('foo', null, 'Foo');
        $myMethod->addParameter('bar', 'null', 'Bar');
        $myMethodBody = $blockFactory->create();
        $myMethodBody
            ->add('$foobar = $foo->toString();')
            ->add('')
            ->add('if (!is_null($bar)) {')
            ->startIndention()
                ->add('$foobar .= $bar->toString();')
            ->stopIndention()
            ->add('}')
            ->add('')
            ->add('return $foobar');
        $myMethod->setBody($myMethodBody, 'string');

        echo $myMethod->generate() . PHP_EOL;
    }
}

$example = new MethodExample();
$example->demonstrate();