<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-05-24 
 */

require_once 'AbstractExample.php';
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Class ClassExample
 * @package Net\Bazzline\Component\CodeGenerator\Example
 */
class ClassExample extends AbstractExample
{
    /**
     * @return string
     */
    function demonstrate()
    {
        $blockFactory           = $this->getBlockGeneratorFactory();
        $classFactory           = $this->getClassGeneratorFactory();
        $constantFactory        = $this->getConstantGeneratorFactory();
        $documentationFactory   = $this->getDocumentationGeneratorFactory();
        $methodFactory          = $this->getMethodGeneratorFactory();
        $propertyFactory        = $this->getPropertyGeneratorFactory();
        $traitFactory           = $this->getTraitGeneratorFactory();

        $myConstant = $constantFactory->create();
        $myConstant->setName('MY_CONSTANT');
        $myConstant->setValue('foobar');

        $myProperty = $propertyFactory->create();
        $myProperty->setDocumentation($documentationFactory->create());
        $myProperty->markAsProtected();
        $myProperty->setName('myProperty');
        $myProperty->setValue(12345678.90);
        $myProperty->addTypeHint('float');

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

        $myTrait = $traitFactory->create();
        $myTrait->setDocumentation($documentationFactory->create());
        $myTrait->setName('myTrait');

        $myClass = $classFactory->create();
        $myClass->setDocumentation($documentationFactory->create());
        $myClass->setNamespace('My\Namespace');
        $myClass->setName('MyClass');
        $myClass->markAsFinal();
        $myClass->setExtends('Foo\Bar', true);
        $myClass->addImplements('Bar\FooInterface', true);
        $myClass->addConstant($myConstant);
        $myClass->addMethod($myMethod);
        $myClass->addProperty($myProperty);
        $myClass->addTrait($myTrait);
        $myClass->getDocumentation()->setAuthor('stev leibelt', 'artodeto@bazzline.net');
        $myClass->getDocumentation()->setVersion('0.8.15', 'available since 2014-05-24');

        echo $myClass->generate() . PHP_EOL;
    }
}

$example = new ClassExample();
$example->demonstrate();