<?php
require __DIR__.'/ClassLoader.php';

$paths = require __DIR__.'/class_map.php';

$loader = new ClassLoader($paths);

$loader->register();
