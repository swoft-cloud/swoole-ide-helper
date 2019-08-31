<?php declare(strict_types=1);

require __DIR__ . '/src/ArgTypes.php';
require __DIR__ . '/src/ExtStubExporter.php';

echo "Generate IDE Helper Classes For Swoole Ext\n";
echo 'Swoole Version: v' . swoole_version() . "\n\n";
try {
    $dumper = new ExtStubExporter();
    $dumper->export();

    echo "\nExport Successful\n";
} catch (Throwable $e) {
    echo "\nExport Failure!\nException: ", $e->getMessage(), "\n";
}
