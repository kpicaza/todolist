<?php

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Helper\FormatterHelper;

// Console enviroment default "test"
$console->getDefinition()->addOption(
    new InputOption('--env', null, InputOption::VALUE_REQUIRED, 'The Environment name.', 'test')
);

$console->setHelperSet(
    new HelperSet([
        'question' => new QuestionHelper(),
        'formatter' => new FormatterHelper(),
    ])
);
