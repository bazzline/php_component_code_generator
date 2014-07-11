#!/bin/php
<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-07-11 
 */

require_once 'AbstractExample.php';
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Class FileExample
 */
class FileExample extends AbstractExample
{
    /**
     * @return mixed
     */
    function demonstrate()
    {
        //----begin of factories
        $classFactory           = $this->getClassGeneratorFactory();
        $constantFactory        = $this->getConstantGeneratorFactory();
        $documentationFactory   = $this->getDocumentationGeneratorFactory();
        $fileFactory            = $this->getFileGeneratorFactory();
        $methodFactory          = $this->getMethodGeneratorFactory();
        //----end of factories

        //----begin of generators
        $class          = $classFactory->create();
        $constant       = $constantFactory->create();
        $fileGenerator  = $fileFactory->create();
        $method         = $methodFactory->create();
        //----end of generators

        //----begin content creation
        $class->setDocumentation($documentationFactory->create());
        $class->setName('MyClass');
        $class->setNamespace('MyClassNamespace');

        $constant->setName('MY_CONSTANT');
        $constant->setValue('123');

        $content = 'echo \'hello world\' . PHP_EOL;';

        $fileGenerator->setDocumentation($documentationFactory->create());

        $method->setDocumentation($documentationFactory->create());
        $method->setName('myMethod');
        //----end content creation

        //----begin of file generation
        $fileGenerator->markAsExecutable();
        $fileGenerator->addClass($class);
        $fileGenerator->addConstant($constant);
        $fileGenerator->addFileContent($content);
        $fileGenerator->addMethod($method);
        //----end of file generation

        //----begin of output
        echo 'generated content' . PHP_EOL;
        echo '----' . PHP_EOL;
        echo $fileGenerator->generate() . PHP_EOL;
        //----end of output
    }
}

$example = new FileExample();
$example->demonstrate();