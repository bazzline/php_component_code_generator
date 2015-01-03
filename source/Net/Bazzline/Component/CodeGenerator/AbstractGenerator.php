<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-24 
 */

namespace Net\Bazzline\Component\CodeGenerator;

/**
 * Class AbstractGenerator
 * @package Net\Bazzline\Component\Locator\LocatorGenerator\Generator
 */
abstract class AbstractGenerator extends AbstractBasicGenerator implements BlockGeneratorDependentInterface, LineGeneratorDependentInterface
{
    /** @var boolean */
    private $canBeGenerated;

    /** @var BlockGenerator */
    private $blockGenerator;

    /** @var LineGenerator */
    private $lineGenerator;

    /** @var array */
    private $properties = array();

    public function __construct()
    {
        $this->properties = array();
    }

    /**
     * @return $this
     */
    public function clear()
    {
        $this->properties = array();
        $this->resetContent();
    }

    /**
     * @return $this
     */
    public function __clone()
    {
        $this->clear();
    }

    /**
     * @param BlockGenerator $generator
     * @return $this
     */
    public function setBlockGenerator(BlockGenerator $generator)
    {
        $this->blockGenerator = $generator;

        return $this;
    }

    /**
     * @param LineGenerator $generator
     * @return $this
     */
    public function setLineGenerator(LineGenerator $generator)
    {
        $this->lineGenerator = $generator;

        return $this;
    }

    /**
     * @param Indention $indention
     * @return $this
     */
    final public function setIndention(Indention $indention)
    {
        parent::setIndention($indention);
        $this->blockGenerator->setIndention($indention);
        $this->lineGenerator->setIndention($indention);

        return $this;
    }

    /**
     * @return boolean
     */
    public function hasContent()
    {
        return (!empty($this->properties));
    }

    /**
     * @return $this
     */
    final protected function markAsCanBeGenerated()
    {
        $this->canBeGenerated = true;

        return $this;
    }

    /**
     * @return bool
     */
    final protected function canBeGenerated()
    {
        return ($this->canBeGenerated === true);
    }

    /**
     * @param string $name
     * @param mixed $value
     * @param bool $isStackable
     */
    final protected function addGeneratorProperty($name, $value, $isStackable = true)
    {
        $name = (string) $name;

        if ($isStackable) {
            if ((!isset($this->properties[$name]))
                || (!is_array($this->properties[$name]))) {
                $this->properties[$name] = array();
            }
            $this->properties[$name][] = $value;
        } else {
            if (!isset($this->properties[$name])) {
                $this->properties[$name] = null;
            }
            $this->properties[$name] = $value;
        }

        $this->markAsCanBeGenerated();
    }

    /**
     * @param string|AbstractGenerator[] $content
     * @param bool $isIndented
     * @throws InvalidArgumentException
     * @todo extend addContent to support int|string|array|LineGenerator|BlockGenerator
     */
    final protected function addContent($content, $isIndented = false)
    {
        if ($isIndented) {
            $this->getIndention()->increaseLevel();
        }
        if (!($content instanceof AbstractGenerator)) {
            if (is_array($content)) {
                $content = $this->getBlockGenerator($content);
            } else {
                $content = $this->getLineGenerator($content);
            }
        }
        //@todo why? - take a look to BlockGenerator->generate(), strings are not supported
        $content = $content->generate();
        if ($isIndented) {
            $this->getIndention()->decreaseLevel();
        }
        $this->blockGenerator->add($content);
    }

    /**
     * @param GeneratorInterface $generator
     * @param bool $isIndented - needed?
     */
    final protected function addGeneratorAsContent(GeneratorInterface $generator, $isIndented = false)
    {
        $generator->setIndention($this->getIndention());
        $this->addContent(
            explode(
                PHP_EOL,
                $generator->generate()
            ),
            $isIndented
        );
    }

    /**
     * @return string
     */
    final protected function generateStringFromContent()
    {
        return $this->blockGenerator->generate();
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return null|string|array
     */
    final protected function getGeneratorProperty($name, $default = null)
    {
        return (isset($this->properties[$name])) ? $this->properties[$name] : $default;
    }

    /**
     * @param null|string|LineGenerator|BlockGenerator $content
     * @return BlockGenerator
     */
    final protected function getBlockGenerator($content = null)
    {
        $block = clone $this->blockGenerator;
        $block->setIndention($this->getIndention());

        if (!is_null($content)) {
            $block->add($content);
        }

        return $block;
    }

    /**
     * @param null|string $content
     * @return LineGenerator
     */
    final protected function getLineGenerator($content = null)
    {
        $line = clone $this->lineGenerator;
        $line->setIndention($this->getIndention());

        if (!is_null($content)) {
            $line->add($content);
        }

        return $line;
    }

    /**
     * @return array
     */
    final protected function getNotPrintableTypeHints()
    {
        return array('bool', 'boolean', 'int', 'integer', 'object', 'resource', 'string');
    }

    /**
     * @param array $array
     * @return mixed
     */
    final protected function getLastArrayKey(array $array)
    {
        end($array);
        $lastArrayKey = key($array);
        reset($array);

        return $lastArrayKey;
    }

    /**
     * @return $this
     */
    final protected function resetContent()
    {
        $this->blockGenerator = $this->getBlockGenerator();

        return $this;
    }
}