<?php

declare(strict_types=1);

$paths = array_slice($argv, 1);

if ($paths === []) {
    $paths = ['src', 'tests'];
}

$files = [];

foreach ($paths as $path) {
    if (is_file($path)) {
        $files[] = $path;
        continue;
    }

    if (!is_dir($path)) {
        fwrite(STDERR, sprintf("Path not found: %s\n", $path));
        exit(1);
    }

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)
    );

    foreach ($iterator as $fileInfo) {
        if ($fileInfo->getExtension() === 'php') {
            $files[] = $fileInfo->getPathname();
        }
    }
}

sort($files);

foreach ($files as $file) {
    $command = sprintf('%s -l %s 2>&1', escapeshellarg(PHP_BINARY), escapeshellarg($file));
    exec($command, $output, $exitCode);

    foreach ($output as $line) {
        fwrite(STDOUT, $line . PHP_EOL);
    }

    if ($exitCode !== 0) {
        exit($exitCode);
    }

    $output = [];
}

fwrite(STDOUT, sprintf("Linted %d PHP files.\n", count($files)));
