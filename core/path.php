<?php

function resolveViewPath($viewfile) {
    $baseDir = __DIR__;
    $viewFilePath = $baseDir . '/../views/' . $viewfile . '.php';
    $viewFilePath = str_replace('\\', '/', $viewFilePath);
    $viewFilePath = realpath($viewFilePath);
    return $viewFilePath;
}

function resolveModulePath($modulefile) {
    $baseDir = __DIR__;
    $moduleFilePath = $baseDir . '/../modules/' . $modulefile . '.php';
    $moduleFilePath = str_replace('\\', '/', $moduleFilePath);
    $moduleFilePath = realpath($moduleFilePath);
    return $moduleFilePath;
}

function resolveCorePath($corefile) {
    $baseDir = __DIR__;
    $coreFilePath = $baseDir . '/' . $corefile . '.php';
    $coreFilePath = str_replace('\\', '/', $coreFilePath);
    $coreFilePath = realpath($coreFilePath);
    return $coreFilePath;
}
?>