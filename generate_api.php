#!/usr/bin/php
<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-02-07
 */

if ($argc != 2) {
    echo 'Usage: ' . basename(__FILE__) . ' <path to apigen>' . PHP_EOL;
    exit(1);
}

$pathToApiGen = $argv[1];

if (!is_readable($pathToApiGen)) {
    echo 'path to apigen "' . $pathToApiGen . ' is not readable' . PHP_EOL;
    exit(1);
}

$path = __DIR__;
//delete
$command = 'rm -fr ' . $path . '/document/*';
passthru($command);

//generate
$options = array(
    '--source source/Net/Bazzline/Component/CodeGenerator/',
    '--destination ' . $path . '/document/',
    '--title "Code Generator by Bazzline"'
);
$command = 'php ' . $pathToApiGen . ' generate ' . implode(' ', $options);
passthru($command);
