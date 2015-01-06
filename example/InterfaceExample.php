#!/bin/php
<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-07-12 
 */

require_once 'AbstractExample.php';
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Class InterfaceExample
 */
class InterfaceExample extends AbstractExample
{
    /**
     * @return mixed
     */
    function demonstrate()
    {
        //----begin of factories
        $interfaceFactory       = $this->getInterfaceGeneratorFactory();
        $documentationFactory   = $this->getDocumentationGeneratorFactory();
        $methodFactory          = $this->getMethodGeneratorFactory();
        //----end of factories

        //----begin of generators
        $interface      = $interfaceFactory->create();
        $method         = $methodFactory->create();
        //----end of generators

        //----begin content creation
        $interface->setDocumentation($documentationFactory->create());
        $interface->setName('FooInterface');
        $interface->setNamespace('My\\Example');
        $interface->addExtends('BarInterface', true);

        $method->setDocumentation($documentationFactory->create());
        $method->setName('foo');
        $method->markAsHasNoBody();
        $method->markAsPublic();
        $method->getDocumentation()
            ->setReturn('string');
        //----end content creation

        //----begin of interface generation
        $interface->addMethod($method);
        //----end of interface generation

        //----begin of output
        echo 'generated content' . PHP_EOL;
        echo '----' . PHP_EOL;
        echo $interface->generate() . PHP_EOL;
        //----end of output
    }
}

$example = new InterfaceExample();
$example->demonstrate();
