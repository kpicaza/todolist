<?php

require_once __DIR__ . '/parameters.php';

$config['monolog']['monolog.logfile'] = __DIR__ . '/../../var/logs/dev.log';

$config['_profiler'] = [
    'profiler.cache_dir' => __DIR__.'/../../var/cache/profiler',
    'profiler.mount_prefix' => '/_profiler', // this is the default

];
