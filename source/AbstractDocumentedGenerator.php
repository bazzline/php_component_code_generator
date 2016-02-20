<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-05-02 
 */

namespace Net\Bazzline\Component\CodeGenerator;

/**
 * Class AbstractDocumentedGenerator
 * @package Net\Bazzline\Component\Locator\LocatorGenerator\Generator
 * @author stev leibelt <artodeto@bazzline.net>
 */
abstract class AbstractDocumentedGenerator extends AbstractGenerator
{
    /** @var bool */
    protected $completeDocumentationAutomatically = false;

    /**
     * @return null|DocumentationGenerator
     */
    final public function getDocumentation()
    {
        return $this->getGeneratorProperty('documentation');
    }

    /**
     * @param DocumentationGenerator $documentation
     * @param bool $completeAutomatically
     */
    final public function setDocumentation(DocumentationGenerator $documentation, $completeAutomatically = true)
    {
        $this->addGeneratorProperty('documentation', $documentation, false);
        $this->completeDocumentationAutomatically = $completeAutomatically;
    }
}