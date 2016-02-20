<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-05-03 
 */

namespace Net\Bazzline\Component\CodeGenerator;

/**
 * Interface IndentionAwareInterface
 * @package Net\Bazzline\Component\CodeGenerator
 */
interface IndentionAwareInterface
{
    /**
     * @return null|Indention
     */
    public function getIndention();

    /**
     * @param Indention $indention
     * @return $this
     */
    public function setIndention(Indention $indention);
} 