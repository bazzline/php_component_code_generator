<?php
/**
 * @author sleibelt
 * @since 2014-04-25
 */

namespace Net\Bazzline\Component\CodeGenerator;

/**
 * Class LineGenerator
 *
 * @package Net\Bazzline\Component\Locator\LocatorGenerator
 */
class LineGenerator extends AbstractContentGenerator
{
    /** @var array|string[] */
    private $content = [];

    /** @var string */
    private $separator = ' ';

    /**
     * @param string|array|GeneratorInterface[]|AbstractContentGenerator[] $content
     * @return $this
     * @throws InvalidArgumentException
     */
    public function add($content)
    {
        if (is_string($content)) {
            $this->content[] = $content;
        } else if ($content instanceof LineGenerator) {
            $this->content[] = $content->generate();
        } else if (is_array($content)) {
            foreach ($content as $part) {
                $this->add($part);
            }
        } else if ($content instanceof AbstractContentGenerator) {
            $content->setIndention($this->getIndention());
            if ($content->hasContent()) {
                $this->content[] = $content->generate();
            }
        } else {
            throw new InvalidArgumentException('content has to be string, an array or instance of AbstractContentGenerator');
        }

        return $this;
    }

    /**
     * @param $separator
     */
    public function setSeparator($separator)
    {
        $this->separator = (string) $separator;
    }

    public function clear()
    {
        $this->content = [];
    }

    /**
     * @return bool
     */
    public function hasContent()
    {
        return (!empty($this->content));
    }

    /**
     * @throws InvalidArgumentException|RuntimeException
     * @return string
     */
    public function generate()
    {
        return (implode('', $this->content) !== '') ? $this->getIndention()->toString() . implode($this->separator, $this->content) : '';
    }

    /**
     * @return int
     */
    public function count()
    {
        return (count($this->content));
    }
}
