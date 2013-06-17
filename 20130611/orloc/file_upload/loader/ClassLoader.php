<?php

class ClassLoader { 
    
    private $paths;

    public function __construct(array $paths) { 

        $this->paths = $paths;    

    }

    public function register($prepend = false) { 
        spl_autoload_register(array($this, 'loadClass'), true, $prepend);
    }

    public function loadClass($class){
        if (isset($this->paths[$class])){
            include $this->paths[$class];
            
            return true;
        }
    }
}
