<?php

$finder = PhpCsFixer\Finder::create()
    ->in('src')
    ->in('tests')
;

return PhpCsFixer\Config::create()
    ->setUsingCache(true)
    ->setRules([
        '@Symfony' => true,
        'concat_space' => ['spacing' => 'one'],
        'ordered_imports' => true,
        'phpdoc_align' => true,
        'array_syntax' => ['syntax' => 'short'],
        'strict_comparison' => true,
        'strict_param' => true,
        'phpdoc_to_comment' => false
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(true)
;
