# PHP Code Generator

This project aims to deliver a easy to use php code generator.
PHPDOC-Generation is also implemented as general generation tasks like "class", "function" or "property" generation.

This component comes with a lot of [examples](https://github.com/stevleibelt/php_component_code_generator/tree/master/example) as well as default [factories](https://github.com/stevleibelt/php_component_code_generator/tree/master/source/Net/Bazzline/Component/CodeGenerator/Factory).

Take a look on [ohloh.net](https://www.ohloh.net/p/php_component_code_generator).

The build status of the current master branch is tracked by Travis CI: 

[![Build Status](https://travis-ci.org/stevleibelt/php_component_code_generator.png?branch=master)](http://travis-ci.org/stevleibelt/php_component_code_generator)

# Install

## Manuel

    mkdir -p vendor/net_bazzline/php_component_code_generator
    cd vendor/net_bazzline/php_component_code_generator
    git clone https://github.com/stevleibelt/php_component_code_generator .

## With [Packagist](https://packagist.org/packages/net_bazzline/php_component_code_generator)

    composer require net_bazzline/php_component_code_generator:dev-master

# Future Improvements

* remove @tods in source code
* implement [automatically documentation](https://github.com/wells5609/CodeGenerator)
* [flavour api](https://github.com/propelorm/Propel/blob/master/generator/lib/builder/om/OMBuilder.php)
* [extend trait](https://github.com/Speicher210/CodeGenerator/blob/master/docs/php/oop/generate-trait.md)
* [extend indention](https://github.com/Speicher210/CodeGenerator/blob/master/src/Wingu/OctopusCore/CodeGenerator/GeneratorInterface.php)
* implement [annotation](https://github.com/Speicher210/CodeGenerator/tree/master/src/Wingu/OctopusCore/CodeGenerator/PHP/Annotation)
* implement validation
* use symfony console and commands
    * add user interaction (ask if file should be overwritten/saved
* what about something like [that](https://github.com/zetacomponents/PhpGenerator/blob/master/docs/example_general.php)

# Inspired By

* [php-generator](https://github.com/nette/php-generator)
* [simple-php-code-gen](https://github.com/gotohr/simple-php-code-gen)
* [cg-library](https://github.com/schmittjoh/cg-library)
* [sensio generator bundle](https://github.com/sensiolabs/SensioGeneratorBundle)
* [php-ide-stub-generator](https://github.com/racztiborzoltan/php-ide-stub-generator)
* [php-token-reflection](https://github.com/Andrewsville/PHP-Token-Reflection)
* [code-generator](https://github.com/Speicher210/CodeGenerator)

# History

* [0.0.3](https://github.com/stevleibelt/php_component_code_generator/tree/0.0.3) - not yet released
    * fixed broken strict tests
* [0.0.2](https://github.com/stevleibelt/php_component_code_generator/tree/0.0.2) - released at 05.06.2014
    * fixed bug in BlockGenerator::startIndention() - now multiple calls are supported
    * added method Indention::isSetToInitialLevel();
    * fixed logical bug by replacing "addExtends" to "setExtends" since it is not allowed to extend from more than one class
* [0.0.1](https://github.com/stevleibelt/php_component_code_generator/tree/0.0.1) - released at 25.05.2014
    * covered main code with tests
    * created [examples](https://github.com/stevleibelt/php_component_code_generator/tree/0.0.1/example)
    * created [factories](https://github.com/stevleibelt/php_component_code_generator/tree/0.0.1/source/Net/Bazzline/Component/CodeGenerator/Factory)
