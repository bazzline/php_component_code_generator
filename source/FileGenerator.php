<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-05-14 
 */

namespace Net\Bazzline\Component\CodeGenerator;

/**
 * Class FileGenerator
 * @package Net\Bazzline\Component\CodeGenerator
 */
class FileGenerator extends AbstractDocumentedGenerator
{
    /** @var boolean */
    private $addEmptyLine;

    /**
     * @param ConstantGenerator $constant
     * @return $this
     */
    public function addConstant(ConstantGenerator $constant)
    {
        $this->addGeneratorProperty('constants', $constant);

        return $this;
    }

    /**
     * @param PropertyGenerator $property
     * @return $this
     */
    public function addProperty(PropertyGenerator $property)
    {
        $this->addGeneratorProperty('properties', $property);

        return $this;
    }

    /**
     * @param ClassGenerator $class
     * @return $this
     */
    public function addClass(ClassGenerator $class)
    {
        $this->addGeneratorProperty('classes', $class);

        return $this;
    }

    /**
     * @param InterfaceGenerator $interface
     * @return $this
     */
    public function addInterface(InterfaceGenerator $interface)
    {
        $this->addGeneratorProperty('interfaces', $interface);

        return $this;
    }

    /**
     * @param MethodGenerator $method
     * @return $this
     */
    public function addMethod(MethodGenerator $method)
    {
        $this->addGeneratorProperty('methods', $method);

        return $this;
    }

    /**
     * @param TraitGenerator $trait
     * @return $this
     */
    public function addTrait(TraitGenerator $trait)
    {
        $this->addGeneratorProperty('traits', $trait->getName());

        return $this;
    }

    public function markAsExecutable()
    {
        $this->addGeneratorProperty('is_executable', true, false);

        return $this;
    }

    /**
     * @param int|string|array $content
     * @return $this
     * @todo add support for Generator as type
     */
    public function addFileContent($content)
    {
        if (!is_array($content)) {
            $content = array($content);
        }

        foreach ($content as $partial) {
            $this->addGeneratorProperty('content', $partial);
        }

        return $this;
    }

    /**
     * @throws InvalidArgumentException|RuntimeException
     * @return string
     * @todo implement exception throwing if mandatory parameter is missing
     */
    public function generate()
    {
        if ($this->canBeGenerated()) {
            $this->resetContent();
            $this->addEmptyLine = false;
            $isExecutable = $this->getGeneratorProperty('is_executable', false);
            if ($isExecutable) {
                $this->addContent('#!/bin/php');
            }

            $this->addContent('<?php');
            $this->generateContent();
            $this->generateConstants();
            $this->generateProperties();
            $this->generateTraits();
            $this->generateMethods();
            $this->generateInterfaces();
            $this->generateClasses();
        }

        return $this->generateStringFromContent();
    }

    private function generateContent()
    {
        $content = $this->getGeneratorProperty('content', array());

        foreach ($content as $partial) {
            $this->addContent($partial);
        }
        $this->addEmptyLine = true;
    }

    private function generateConstants()
    {
        /** @var null|ConstantGenerator[] $constants */
        $constants = $this->getGeneratorProperty('constants');

        $this->addContentFromCollectionTwo($constants);
    }

    private function generateProperties()
    {
        /** @var null|PropertyGenerator[] $properties */
        $properties = $this->getGeneratorProperty('properties');

        $this->addContentFromCollectionTwo($properties);
    }

    private function generateTraits()
    {
        /** @var null|array $traits */
        $traits = $this->getGeneratorProperty('traits');

        $this->addContentFromCollectionTwo($traits);
    }

    private function generateMethods()
    {
        /** @var null|MethodGenerator[] $methods */
        $methods = $this->getGeneratorProperty('methods');

        $this->addContentFromCollectionTwo($methods);
    }

    private function generateClasses()
    {
        /** @var null|ClassGenerator[] $classes */
        $classes = $this->getGeneratorProperty('classes');

        $this->addContentFromCollection($classes);
    }

    private function generateInterfaces()
    {
        /** @var null|InterfaceGenerator[] $interfaces */
        $interfaces = $this->getGeneratorProperty('interfaces');

        $this->addContentFromCollection($interfaces);
    }

    /**
     * @param null|array $collection
     * @todo figure out difference between addContentFromCollection and
     *  addContentFromCollectionTwo and express difference with fitting names
     */
    private function addContentFromCollection($collection)
    {
        if (is_array($collection)) {
            if ($this->addEmptyLine) {
                $this->addContent('');
            }
            $keys = array_keys($collection);
            $lastKey = array_pop($keys);

            foreach($collection as $key => $item) {
                $this->addGeneratorAsContent($item);
                if ($key !== $lastKey) {
                    $this->addContent('');
                }
            }
        }
    }

    /**
     * @param null|array $collection
     */
    private function addContentFromCollectionTwo($collection)
    {
        if (is_array($collection)) {
            if ($this->addEmptyLine) {
                $this->addContent('');
            }
            $lastKey = $this->getLastArrayKey($collection);
            foreach($collection as $key => $item) {
                $this->addGeneratorAsContent($item);
                if ($key !== $lastKey) {
                    $this->addContent('');
                }
            }
        }
        $this->addEmptyLine = true;
    }
}
