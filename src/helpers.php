<?php

if (!function_exists('env')) {
    function env(string $variable, $default = '') {
        return $default;
    }
}

if (!function_exists('config')) {
    function config(string $variable, $default = '') {
        $config = include(__DIR__ . '/../config/billingo.php');
        $fields = explode(".", $variable);

        return $config[$fields[1]] ?? $default;
    }
}