<?php
const DIR_CONFIG = '/../config';
require_once __DIR__ . '/../vendor/autoload.php';

function getConfigs(string $path = DIR_CONFIG): array {
    $settings = [];
    foreach (scandir(__DIR__ . $path) as $file) {
        if ($file !== '.' && $file !== '..') {
            $name = explode('.', $file)[0];
            $settings[$name] = include __DIR__ . "$path/$file";
        }
    }
    return $settings;
}

require_once __DIR__ . '/../routes/web.php';
return new Src\Application(new Src\Settings(getConfigs()));