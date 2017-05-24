#!/bin/php
<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-05-14 
 */

require_once 'AbstractExample.php';
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Class DTOGeneratorExample
 * @package Net\Bazzline\Component\CodeGenerator\Example
 */
class DTOGeneratorExample extends AbstractExample
{
    /**
     * @return string
     */
    function demonstrate()
    {
        //---- begin of factories
        $classFactory = $this->getClassGeneratorFactory();
        $documentationFactory = $this->getDocumentationGeneratorFactory();
        $methodFactory = $this->getMethodGeneratorFactory();
        $propertyFactory = $this->getPropertyGeneratorFactory();
        //---- end of factories

        $class = $classFactory->create();
        $class->setDocumentation($documentationFactory->create());
        $class->setName('ExampleDTO');

        $properties = [
            [
                'name'      => 'foo',
                'typeHint'  => null,
                'value'     => 42
            ],
            [
                'name'      => 'foobar',
                'typeHint'  => 'array',
                'value'     => null
            ],
            [
                'name'      => 'bar',
                'typeHint'  => 'Bar',
                'value'     => null
            ]
        ];

        foreach ($properties as $value) {
            //---- begin of properties
            $property = $propertyFactory->create();
            $property->setDocumentation($documentationFactory->create());
            $property->setName($value['name']);
            if (!is_null($value['value'])) {
                $property->setValue('value');
            }
            $property->markAsPrivate();
            $property->setDocumentation($documentationFactory->create());
            //---- end of properties

            //---- begin of getter method
            $getterMethod = $methodFactory->create();
            $getterMethod->setDocumentation($documentationFactory->create());
            $getterMethod->setName('get' . ucfirst($value['name']));
            $getterMethod->setBody(
                [
                    '$this->' . $value['name'] . ' = $' . $value['name'] . ';'
                ], 
                [
                    $value['typeHint']
                ]
            );
            //---- end of getter method

            //---- begin of setter method
            $setterMethod = $methodFactory->create();
            $setterMethod->setDocumentation($documentationFactory->create());
            $setterMethod->addParameter($value['name'], null, $value['typeHint']);
            $setterMethod->setName('set' . ucfirst($value['name']));
            $setterMethod->setBody(
                [
                    'return $this->' . $value['name'] . ';'
                ]
            );
            //---- end of setter method

            $class->addProperty($property);
            $class->addMethod($getterMethod);
            $class->addMethod($setterMethod);
        }

        echo 'generated content' . PHP_EOL;
        echo '----' . PHP_EOL;
        echo $class->generate() . PHP_EOL;
    }
}

$example = new DTOGeneratorExample();
$example->demonstrate();
