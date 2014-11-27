# PHP Code Generator

This project aims to deliver a easy to use php code generator.
PHPDOC-Generation is also implemented as general generation tasks like "class", "function" or "property" generation.

The build status of the current master branch is tracked by Travis CI: 
[![Build Status](https://travis-ci.org/bazzline/php_component_code_generator.png?branch=master)](http://travis-ci.org/bazzline/php_component_code_generator)
[![Latest stable](https://img.shields.io/packagist/v/net_bazzline/php_component_code_generator.svg)](https://packagist.org/packages/net_bazzline/php_component_code_generator)

The scrutinizer status are:
[![code quality](https://scrutinizer-ci.com/g/bazzline/php_component_code_generator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bazzline/php_component_code_generator/) | [![code coverage](https://scrutinizer-ci.com/g/bazzline/php_component_code_generator/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/bazzline/php_component_code_generator/) | [![build status](https://scrutinizer-ci.com/g/bazzline/php_component_locator_generator/badges/build.png?b=master)](https://scrutinizer-ci.com/g/bazzline/php_component_code_generator/)

The versioneye status is:
[![Dependency Status](https://www.versioneye.com/user/projects/54036dbbeab62ac615000143/badge.svg?style=flat)](https://www.versioneye.com/user/projects/54036dbbeab62ac615000143)

This component comes with a lot of [examples](https://github.com/bazzline/php_component_code_generator/tree/master/example) as well as default [factories](https://github.com/bazzline/php_component_code_generator/tree/master/source/Net/Bazzline/Component/CodeGenerator/Factory).

Take a look on [ohloh.net](https://www.ohloh.net/p/php_component_code_generator).

# Install

## By Hand

    mkdir -p vendor/net_bazzline/php_component_code_generator
    cd vendor/net_bazzline/php_component_code_generator
    git clone https://github.com/bazzline/php_component_code_generator .

## With [Packagist](https://packagist.org/packages/net_bazzline/php_component_code_generator)

    composer require net_bazzline/php_component_code_generator:dev-master

# Benefits

* no "new" inside classes ...
* independent and configurable indention
* no static calls
* shipped with examples and factories
* covered with unittests
* open source
* automatic phpdoc generation

# Optimization Potential 

* ... but "clone"
* currently not widely used 
* no code review by other developers so far
* still open todo's

# API

Thanks to [apigen](https://github.com/apigen/apigen), the api is available in the [document](https://github.com/bazzline/php_component_code_generator/blob/master/document/index.html) section or [online](http://code.bazzline.net/).

# Future Improvements

* implement possibility to use some ["pre defined" methods](https://github.com/wells5609/CodeGenerator/tree/master/src/CodeGenerator/Method) for generation
* remove @todo's in source code
* implement method ordering by visibility and final|!final status in ClassGenerator to get some automatic ordering of public|protected|private methods for generation
* [flavour api](https://github.com/propelorm/Propel/blob/master/generator/lib/builder/om/OMBuilder.php)
* [extend trait](https://github.com/Speicher210/CodeGenerator/blob/master/docs/php/oop/generate-trait.md)
* [extend indention](https://github.com/Speicher210/CodeGenerator/blob/master/src/Wingu/OctopusCore/CodeGenerator/GeneratorInterface.php)
* implement [annotation](https://github.com/Speicher210/CodeGenerator/tree/master/src/Wingu/OctopusCore/CodeGenerator/PHP/Annotation)
* implement validation
* use symfony console and commands
    * add user interaction (ask if file should be overwritten/saved
* what about something like [that](https://github.com/zetacomponents/PhpGenerator/blob/master/docs/example_general.php)
* implement [automatically documentation](https://github.com/wells5609/CodeGenerator) (validate if this is still better than current approach)

# Inspired By

* [php-generator](https://github.com/nette/php-generator)
* [simple-php-code-gen](https://github.com/gotohr/simple-php-code-gen)
* [cg-library](https://github.com/schmittjoh/cg-library)
* [sensio generator bundle](https://github.com/sensiolabs/SensioGeneratorBundle)
* [php-ide-stub-generator](https://github.com/racztiborzoltan/php-ide-stub-generator)
* [php-token-reflection](https://github.com/Andrewsville/PHP-Token-Reflection)
* [code-generator](https://github.com/Speicher210/CodeGenerator)

# History

* [1.0.2](https://github.com/bazzline/php_component_code_generator/tree/1.0.2) - not yet released
    * added api
    * updated dependencies
* [1.0.1](https://github.com/bazzline/php_component_code_generator/tree/1.0.1) - released at 31.08.2014
    * transfered project to bazzline
    * updated dependencies
* [1.0.0](https://github.com/bazzline/php_component_code_generator/tree/1.0.0) - released at 27.07.2014
    * added example for [interface generator](https://github.com/bazzline/php_component_code_generator/tree/1.0.0/example/InterfaceExample.php)
    * added example for [file generator](https://github.com/bazzline/php_component_code_generator/tree/1.0.0/example/FileExample.php)
* [0.0.3](https://github.com/bazzline/php_component_code_generator/tree/0.0.3) - released at 10.06.2014
    * fixed broken strict tests
    * fixed invalid generation of interfaces
* [0.0.2](https://github.com/bazzline/php_component_code_generator/tree/0.0.2) - released at 05.06.2014
    * fixed bug in BlockGenerator::startIndention() - now multiple calls are supported
    * added method Indention::isSetToInitialLevel();
    * fixed logical bug by replacing "addExtends" to "setExtends" since it is not allowed to extend from more than one class
* [0.0.1](https://github.com/bazzline/php_component_code_generator/tree/0.0.1) - released at 25.05.2014
    * covered main code with tests
    * created [examples](https://github.com/bazzline/php_component_code_generator/tree/0.0.1/example)
    * created [factories](https://github.com/bazzline/php_component_code_generator/tree/0.0.1/source/Net/Bazzline/Component/CodeGenerator/Factory)
