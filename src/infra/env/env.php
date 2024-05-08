<?php

// TODO Move this to a class with a cleaner strategy
// https://www.sourcecodester.com/tutorial/php/16035/load-environment-variables-env-file-using-php-tutorial
$envFilePath = ".env";

if (!is_file($envFilePath)) {
    throw new ErrorException("Environment File is Missing.");
}

if (!is_readable($envFilePath)) {
    throw new ErrorException("Permission Denied for reading the " . ($envFilePath) . ".");
}

if (!is_writable($envFilePath)) {
    throw new ErrorException("Permission Denied for writing on the " . ($envFilePath) . ".");
}

$variables = array();
$fopen = fopen($envFilePath, 'r');
if ($fopen) {
    while (($line = fgets($fopen)) !== false) {
        $line_is_comment = (substr(trim($line), 0, 1) == '#') ? true : false;
        if ($line_is_comment || empty(trim($line))) {
            continue;
        }
        $line_no_comment = explode("#", $line, 2)[0];
        $env_ex = preg_split('/(\s?)\=(\s?)/', $line_no_comment);
        $env_name = trim($env_ex[0]);
        $env_value = isset($env_ex[1]) ? trim($env_ex[1]) : "";
        $variables[$env_name] = $env_value;
    }
    fclose($fopen);
}

foreach ($variables as $name => $value) {
    putenv("{$name}={$value}");
    $_ENV[$name] = $value;
}
