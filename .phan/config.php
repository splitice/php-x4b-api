<?php

return [
    'target_php_version' => '8.2',
    'directory_list' => [
        'src',
        'tests',
        'vendor',
    ],
    'exclude_analysis_directory_list' => [
        'vendor',
    ],
    'minimum_severity' => 0,
    'dead_code_detection' => false,
    'unused_variable_detection' => true,
    'unused_public_method_parameter_count' => 0,
    'unused_parameter_detection' => true,
];
