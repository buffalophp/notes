<?php
namespace Entity;

use Db\dbConnection;

abstract class abstractEntity { 

    protected $table;
    
    private $db;

    private $properties = array();

    public function __construct(dbConnection $db, $table){
        if (!$table){ 
            throw new \Exception('Must define a table name');
        }
  
        $this->db = $db;

        $this->table = $table;
    }

    protected function save(){
    }

    protected function findAll(){ 
    }

    protected function findBy($key, $value){ 
    }

    private function discoverProperities(){ 
    }
}
