<?php declare(strict_types=1);

require __DIR__ . '/src/TypeMeta.php';
require __DIR__ . '/src/ExtStubExporter.php';

// Create exporter
$dumper = new ExtStubExporter();
$dumper->export();
