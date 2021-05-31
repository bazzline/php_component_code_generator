# Full Stop

I still like the idea but there is currently no use case to develop it anymore.

# PHP Code Generator

This project aims to deliver a easy to use free as in freedom php code generator.
PHPDOC-Generation is also implemented as general generation tasks like "class", "function" or "property" generation.

The build status of the current master branch is tracked by Travis CI: 
[![Build Status](https://travis-ci.org/bazzline/php_component_code_generator.png?branch=master)](http://travis-ci.org/bazzline/php_component_code_generator)
[![Latest stable](https://img.shields.io/packagist/v/net_bazzline/php_component_code_generator.svg)](https://packagist.org/packages/net_bazzline/php_component_code_generator)

The scrutinizer status are:
[![code quality](https://scrutinizer-ci.com/g/bazzline/php_component_code_generator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bazzline/php_component_code_generator/) | [![build status](https://scrutinizer-ci.com/g/bazzline/php_component_locator_generator/badges/build.png?b=master)](https://scrutinizer-ci.com/g/bazzline/php_component_code_generator/)

The versioneye status is:
[![Dependency Status](https://www.versioneye.com/user/projects/54036dbbeab62ac615000143/badge.svg?style=flat)](https://www.versioneye.com/user/projects/54036dbbeab62ac615000143)

This component comes with a lot of [examples](https://github.com/bazzline/php_component_code_generator/tree/master/example) as well as default [factories](https://github.com/bazzline/php_component_code_generator/tree/master/source/Net/Bazzline/Component/CodeGenerator/Factory).

Take a look on [ohloh.net](https://www.ohloh.net/p/php_component_code_generator).

The current change log can be found [here](https://github.com/bazzline/php_component_code_generator/blob/master/CHANGELOG.md).

# Install

## By Hand

```
mkdir -p vendor/net_bazzline/php_component_code_generator
cd vendor/net_bazzline/php_component_code_generator
git clone https://github.com/bazzline/php_component_code_generator .
```

## With [Packagist](https://packagist.org/packages/net_bazzline/php_component_code_generator)

```
composer require net_bazzline/php_component_code_generator:dev-master
```

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

[API](http://www.bazzline.net/57b93db867f58f6bf2982833765721032a5ea22b/index.html) is available at [bazzline.net](http://www.bazzline.net).

# Inspired By

* [php-generator](https://github.com/nette/php-generator)
* [simple-php-code-gen](https://github.com/gotohr/simple-php-code-gen)
* [cg-library](https://github.com/schmittjoh/cg-library)
* [sensio generator bundle](https://github.com/sensiolabs/SensioGeneratorBundle)
* [php-ide-stub-generator](https://github.com/racztiborzoltan/php-ide-stub-generator)
* [php-token-reflection](https://github.com/Andrewsville/PHP-Token-Reflection)
* [code-generator](https://github.com/Speicher210/CodeGenerator)

# Final Words

Star it if you like it :-). Add issues if you need it. Pull patches if you enjoy it. Write a blog entry if you use it. [Donate something](https://gratipay.com/~stevleibelt) if you love it :-].
