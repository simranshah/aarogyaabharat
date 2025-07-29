<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Import Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains configuration settings for data imports.
    |
    */

    'products' => [
        'chunk_size' => env('IMPORT_CHUNK_SIZE', 100),
        'batch_size' => env('IMPORT_BATCH_SIZE', 50),
        'timeout' => env('IMPORT_TIMEOUT', 300), // 5 minutes
        'memory_limit' => env('IMPORT_MEMORY_LIMIT', '512M'),
    ],

    'max_execution_time' => env('MAX_EXECUTION_TIME', 300),
    'memory_limit' => env('MEMORY_LIMIT', '512M'),
]; 