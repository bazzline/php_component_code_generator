# Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Open]

### To Add

* add type hint "array" wherever possible and not only in the documentation
* implement possibility to use some ["pre defined" methods](https://github.com/wells5609/CodeGenerator/tree/master/src/CodeGenerator/Method) for generation
* implement method ordering by visibility and final|!final status in ClassGenerator to get some automatic ordering of public|protected|private methods for generation
* implement [annotation](https://github.com/Speicher210/CodeGenerator/tree/master/src/Wingu/OctopusCore/CodeGenerator/PHP/Annotation)
* implement validation
* implement [automatically documentation](https://github.com/wells5609/CodeGenerator) (validate if this is still better than current approach)

### To Change

* [extend trait](https://github.com/Speicher210/CodeGenerator/blob/master/docs/php/oop/generate-trait.md)
* [extend indention](https://github.com/Speicher210/CodeGenerator/blob/master/src/Wingu/OctopusCore/CodeGenerator/GeneratorInterface.php)
* [flavour api](https://github.com/propelorm/Propel/blob/master/generator/lib/builder/om/OMBuilder.php)
* remove @todo's in source code
* use symfony console and commands
* what about something like [that](https://github.com/zetacomponents/PhpGenerator/blob/master/docs/example_general.php)

## [Unreleased]

### Added

### Changed

## [1.2.1](https://github.com/bazzline/php_component_code_generator/tree/1.2.1) - released at 2017-07-26

### Changed

* fixed broken composer.json

## [1.2.0](https://github.com/bazzline/php_component_code_generator/tree/1.2.0) - released at 2017-05-24

### Added

* added api link
* added integration testing for php 7.0

### Changed

* replaced deprecated array syntax with new one
* removed integration testing for php < 5.6
* removed shipped with api documentation

## [1.1.11](https://github.com/bazzline/php_component_code_generator/tree/1.1.11) - released at 2016-02-20

### Changed

* moved to psr-4 autoloading
* updated dependencies

## [1.1.10](https://github.com/bazzline/php_component_code_generator/tree/1.1.10) - released at 2015-012-11

### Changed

* updated dependencies

## [1.1.9](https://github.com/bazzline/php_component_code_generator/tree/1.1.9) - released at 2015-11-08

### Changed

* updated dependencies

## [1.1.8](https://github.com/bazzline/php_component_code_generator/tree/1.1.8) - released at 2015-08-21

### Changed

* updated dependencies

## [1.1.7](https://github.com/bazzline/php_component_code_generator/tree/1.1.7) - released at 2015-07-29

### Changed

* updated dependencies

## [1.1.6](https://github.com/bazzline/php_component_code_generator/tree/1.1.6) - released at 2015-07-04

### Changed

* updated dependencies

## [1.1.5](https://github.com/bazzline/php_component_code_generator/tree/1.1.5) - released at 2015-05-22

### Changed

* updated dependencies

## [1.1.4](https://github.com/bazzline/php_component_code_generator/tree/1.1.4) - released at 2015-02-08

### Changed

* removed dependency to apigen

## [1.1.3](https://github.com/bazzline/php_component_code_generator/tree/1.1.3) - released at 2015-01-07

### Changed

* fixed bug in SignatureGenerator when auto generating Documentation as Interface

## [1.1.2](https://github.com/bazzline/php_component_code_generator/tree/1.1.2) - released at 2015-01-07

### Added

* added support for InterfaceGenerator to DocumentationGenerator

## [1.1.1](https://github.com/bazzline/php_component_code_generator/tree/1.1.1) - released at 2015-01-07

### Added

* added support for InterfaceGenerator to FileGenerator

## [1.1.0](https://github.com/bazzline/php_component_code_generator/tree/1.1.0) - released at 2015-01-06

### Added

* added api
* created a general SignatureGenerator (extended by InterfaceGenerator and ClassGenerator)

### Changed

* fixed a bug in class generator by creating a interface generator
* by using a interface generator, it is now possible to create an interface that extends more than one interface
* covered new code with unit tests
* updated InterfaceExample
* updated dependencies
* [migration](https://github.com/bazzline/php_component_code_generator/blob/master/migration/1.0.1_to_1.1.0.md) needed

## [1.0.1](https://github.com/bazzline/php_component_code_generator/tree/1.0.1) - released at 2014-08-31

### Changed

* transfered project to bazzline
* updated dependencies

## [1.0.0](https://github.com/bazzline/php_component_code_generator/tree/1.0.0) - released at 2014-07-27

### Added

* added example for [interface generator](https://github.com/bazzline/php_component_code_generator/tree/1.0.0/example/InterfaceExample.php)
* added example for [file generator](https://github.com/bazzline/php_component_code_generator/tree/1.0.0/example/FileExample.php)

## [0.0.3](https://github.com/bazzline/php_component_code_generator/tree/0.0.3) - released at 2014-06-10

### Changed

* fixed broken strict tests
* fixed invalid generation of interfaces

## [0.0.2](https://github.com/bazzline/php_component_code_generator/tree/0.0.2) - released at 2014-06-05

### Added

* added method Indention::isSetToInitialLevel();

### Changed

* fixed bug in BlockGenerator::startIndention() - now multiple calls are supported
* fixed logical bug by replacing "addExtends" to "setExtends" since it is not allowed to extend from more than one class

## [0.0.1](https://github.com/bazzline/php_component_code_generator/tree/0.0.1) - released at 2014-05-25

### Added

* covered main code with tests
* created [examples](https://github.com/bazzline/php_component_code_generator/tree/0.0.1/example)
* created [factories](https://github.com/bazzline/php_component_code_generator/tree/0.0.1/source/Net/Bazzline/Component/CodeGenerator/Factory)
