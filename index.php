<?php

require_once __DIR__ . '/vendor/autoload.php';
use Database\CreateLoggerTable;

// example of using the library
CreateLoggerTable::migrate();
