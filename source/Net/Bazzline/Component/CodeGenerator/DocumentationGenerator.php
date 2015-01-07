<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-24 
 */

namespace Net\Bazzline\Component\CodeGenerator;

/**
 * Class DocumentationGenerator
 * @package Net\Bazzline\Component\Locator\LocatorGenerator\Generator
 * @see http://www.phpdoc.org/docs/latest/index.html
 * @todo implement all tags from phpdoc
 */
class DocumentationGenerator extends AbstractGenerator
{
    /**
     * @var boolean
     * @todo see if it is needed or of phpdoc says
     */
    private $addEmptyLine;

    /**
     * @param string $comment
     * @return $this
     */
    public function addComment($comment)
    {
        $this->addGeneratorProperty('comments', (string) $comment, true);

        return $this;
    }

    /**
     * @param string $className
     * @return $this
     */
    public function setClass($className)
    {
        $this->addGeneratorProperty('class', (string) $className, false);

        return $this;
    }

    /**
     * @param $interfaceName
     * @return $this
     */
    public function setInterface($interfaceName)
    {
        $this->addGeneratorProperty('interface', (string) $interfaceName, false);

        return $this;
    }

    /**
     * @param string $package
     * @return $this
     */
    public function setPackage($package)
    {
        $this->addGeneratorProperty('package', (string) $package, false);

        return $this;
    }

    /**
     * @param string $name
     * @param array $typeHints
     * @param string $comment
     * @return $this
     */
    public function addParameter($name, $typeHints = array(), $comment = '')
    {
        $parameter = array(
            'comment'       => (string) $comment,
            'name'          => (string) $name,
            'type_hints'    => (array) $typeHints
        );

        $this->addGeneratorProperty('parameters', $parameter);

        return $this;
    }

    /**
     * @param array $typeHints
     * @param string $comment
     * @return $this
     */
    public function setReturn($typeHints, $comment = '')
    {
        $return = array(
            'comment'       => (string) $comment,
            'type_hints'    => (array) $typeHints
        );

        $this->addGeneratorProperty('return', $return, false);

        return $this;
    }

    /**
     * @param string $see
     * @return $this
     */
    public function addSee($see)
    {
        $this->addGeneratorProperty('sees', (string) $see);

        return $this;
    }

    /**
     * @param string $exception
     * @return $this
     */
    public function addThrows($exception)
    {
        $this->addGeneratorProperty('throws', (string) $exception);

        return $this;
    }

    /**
     * @param string $toDo
     * @return $this
     */
    public function addTodoS($toDo)
    {
        $this->addGeneratorProperty('todos', (string) $toDo);

        return $this;
    }

    /**
     * @param string $name
     * @param string $email
     * @return $this
     */
    public function setAuthor($name, $email = '')
    {
        $author = array(
            'email' => (string) $email,
            'name'  => (string) $name
        );

        $this->addGeneratorProperty('author', $author, false);

        return $this;
    }

    /**
     * @param string $name
     * @param array $typeHints
     * @return $this
     */
    public function setVariable($name, $typeHints = array())
    {
        $variable = array(
            'name'          => $name,
            'type_hints'    => $typeHints
        );

        $this->addGeneratorProperty('variable', $variable, false);

        return $this;
    }

    /**
     * @param string $number
     * @param string $description
     * @return $this
     * @see http://www.phpdoc.org/docs/latest/for-users/phpdoc/tags/version.html
     */
    public function setVersion($number, $description = '')
    {
        $version = array(
            'description'   => (string) $description,
            'number'        => (string) $number
        );
        $this->addGeneratorProperty('version', $version, false);

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
            $this->addEmptyLine = false;
            $this->resetContent();

            $this->addContent('/**');
            $this->generateSees();
            $this->generateComments();
            $this->generateInterface();
            $this->generateClass();
            $this->generatePackage();
            $this->generateToDoS();
            $this->generateParameters();
            $this->generateReturn();
            $this->generateThrows();
            $this->generateVariable();
            $this->generateAuthor();
            $this->generateVersion();
            $this->addContent(' */');
        }

        return $this->generateStringFromContent();
    }

    private function generateAuthor()
    {
        $author = $this->getGeneratorProperty('author');

        if (is_array($author)) {
            if ($this->addEmptyLine) {
                $this->addContent(' *');
                $this->addEmptyLine = false;
            }

            $line = $this->getLineGenerator(' * @author ' . $author['name']);

            if (strlen($author['email']) > 0) {
                $line->add('<' . $author['email'] . '>');
            }
            $this->addContent($line);
        }
    }

    private function generateClass()
    {
        $class = $this->getGeneratorProperty('class');

        if (is_string($class)) {
            if ($this->addEmptyLine) {
                $this->addContent(' *');
                $this->addEmptyLine = false;
            }

            $line = $this->getLineGenerator(' * Class ' . $class);
            $this->addContent($line);
            $this->addEmptyLine = true;
        }
    }

    private function generateInterface()
    {
        $interface = $this->getGeneratorProperty('interface');

        if (is_string($interface)) {
            if ($this->addEmptyLine) {
                $this->addContent(' *');
                $this->addEmptyLine = false;
            }

            $line = $this->getLineGenerator(' * Interface ' . $interface);
            $this->addContent($line);
            $this->addEmptyLine = true;
        }
    }

    private function generatePackage()
    {
        $package = $this->getGeneratorProperty('package');

        if (is_string($package)) {
            if ($this->addEmptyLine) {
                $this->addContent(' *');
                $this->addEmptyLine = false;
            }

            $line = $this->getLineGenerator(' * @package ' . $package);
            $this->addContent($line);
        }
    }

    private function generateComments()
    {
        $comments = $this->getGeneratorProperty('comments');

        if (is_array($comments)) {
            if ($this->addEmptyLine) {
                $this->addContent(' *');
                $this->addEmptyLine = false;
            }

            foreach ($comments as $comment) {
                $line = $this->getLineGenerator(' * ' . $comment);
                $this->addContent($line);
            }
        }
    }

    private function generateParameters()
    {
        $parameters = $this->getGeneratorProperty('parameters');

        if (is_array($parameters)) {
            if ($this->addEmptyLine) {
                $this->addContent(' *');
                $this->addEmptyLine = false;
            }

            foreach ($parameters as $parameter) {
                $line = $this->getLineGenerator(' * @param');
                if (!empty($parameter['type_hints'])) {
                    $line->add(implode('|', $parameter['type_hints']));
                }
                $line->add('$' . $parameter['name']);
                if (strlen($parameter['comment']) > 0) {
                    $line->add($parameter['comment']);
                }
                $this->addContent($line);
            }
        }
    }

    private function generateReturn()
    {
        $return = $this->getGeneratorProperty('return');

        if (is_array($return)) {
            if ($this->addEmptyLine) {
                $this->addContent(' *');
                $this->addEmptyLine = false;
            }

            $line = $this->getLineGenerator(' * @return');

            if (!empty($return['type_hints'])) {
                $line->add(implode('|', $return['type_hints']));
            }
            if (strlen($return['comment']) > 0) {
                $line->add($return['comment']);
            }
            $this->addContent($line);
        }
    }

    private function generateSees()
    {
        $sees = $this->getGeneratorProperty('sees');

        if (is_array($sees)) {
            if ($this->addEmptyLine) {
                $this->addContent(' *');
                $this->addEmptyLine = false;
            }

            foreach ($sees as $see) {
                $line = $this->getLineGenerator(' * @see ' . $see);
                $this->addContent($line);
            }
        }
    }

    private function generateThrows()
    {
        $throws = $this->getGeneratorProperty('throws');

        if (is_array($throws)) {
            if ($this->addEmptyLine) {
                $this->addContent(' *');
                $this->addEmptyLine = false;
            }

            $line = $this->getLineGenerator(' * @throws ' . implode('|', $throws));
            $this->addContent($line);
        }
    }

    private function generateToDoS()
    {
        $todos = $this->getGeneratorProperty('todos');

        if (is_array($todos)) {
            if ($this->addEmptyLine) {
                $this->addContent(' *');
                $this->addEmptyLine = false;
            }

            foreach ($todos as $todo) {
                $line = $this->getLineGenerator(' * @todo ' . $todo);
                $this->addContent($line);
            }
        }
    }

    private function generateVariable()
    {
        $variable = $this->getGeneratorProperty('variable');

        if (is_array($variable)) {
            if ($this->addEmptyLine) {
                $this->addContent(' *');
                $this->addEmptyLine = false;
            }

            $line =  $this->getLineGenerator(' * @var');
            if (!empty($variable['type_hints'])) {
                $line->add(implode('|', $variable['type_hints']));
            }
            $line->add('$' . $variable['name']);
            $this->addContent($line);
        }
    }

    private function generateVersion()
    {
        $version = $this->getGeneratorProperty('version');

        if (is_array($version)) {
            if ($this->addEmptyLine) {
                $this->addContent(' *');
                $this->addEmptyLine = false;
            }

            $line = $this->getLineGenerator(' * @version ' . $version['number']);
            if (strlen($version['description']) > 0) {
                $line->add($version['description']);
            }
            $this->addContent($line);
        }
    }
}