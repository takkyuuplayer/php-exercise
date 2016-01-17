<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Aura\Cli\CliFactory;

$cli_factory = new CliFactory;
$context = $cli_factory->newContext($GLOBALS);
$options = array(
        'env:',
);
$getopt = $context->getopt($options);

$env = $getopt->get('--env', 'dev');

var_dump($env);
