<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-05-02 
 */

namespace Net\Bazzline\Component\CodeGenerator;

/**
 * Class Indention
 * @package Net\Bazzline\Component\CodeGenerator
 */
class Indention
{
    const FOUR_SPACES_INDENTION = '    ';
    const TAB_INDENTION = "\t";
    const INITIAL_LEVEL = 0;

    /**
     * @var int
     */
    private $level = self::INITIAL_LEVEL;

    /**
     * @var string
     */
    private $string = self::FOUR_SPACES_INDENTION;

    /**
     * @return string
     */
    public function getString()
    {
        return $this->string;
    }

    /**
     * @param string $indention
     * @return $this
     */
    public function setString($indention)
    {
        $this->string = (string) $indention;

        return $this;
    }

    /**
     * @param int $number
     * @return $this
     */
    public function decreaseLevel($number = 1)
    {
        $this->level = (($this->level - $number) < self::INITIAL_LEVEL) ? self::INITIAL_LEVEL : ($this->level - $number);

        return $this;
    }

    /**
     * @param int $number
     * @return $this
     */
    public function increaseLevel($number = 1)
    {
        $this->level += $number;

        return $this;
    }

    /**
     * @return int
     */
    public function isSetToInitialLevel()
    {
        return ($this->level === self::INITIAL_LEVEL);
    }

    /**
     * @return string
     */
    public function toString()
    {
        return (str_repeat($this->string, $this->level));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }
} 