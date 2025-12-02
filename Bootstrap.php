<?php
require_once __DIR__ . '/Core/TestCase.php';

$testFiles = glob(__DIR__ . '/*.test.php');

$tests = [];
foreach ($testFiles as $file) {
    require_once $file;

    $className = basename($file, '.php');
    if (class_exists($className)) {
        $tests[] = new $className();
    }
}

foreach ($tests as $t) {
    $t->run();
}
