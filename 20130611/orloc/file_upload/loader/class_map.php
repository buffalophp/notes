<?php

$loaderDir = dirname(__DIR__). '/src';

$classes = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($loaderDir)
    );

$class_map = array();

foreach ($classes as  $pathname => $fileinfo){ 

    if (!$fileinfo->isFile()) continue;
    
    $last = strrpos($pathname, '/');

    if ($last == false){
        return false;
    }

    $file = substr(substr($pathname, strrpos($pathname, '/', $last - strlen($pathname)-1)), 1);

    $class_name = str_replace('/', '\\', substr($file, 0, -4));
    $class_map[$class_name] = $pathname;
}

return $class_map;
