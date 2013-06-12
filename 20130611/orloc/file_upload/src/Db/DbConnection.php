<?php
namespace Db;

class dbConnection extends \mysqli {

    private static $dbInstance;
  
    private function __construct($config){
        parent::__construct($config['host'], $config['user'], $config['password'], $config['database_name']);

        if (mysqli_connect_error()){
            die('Connection Error('.mysqli_connect_errno().')'. mysqli_connect_error());
        }
    }

    public static function getInstance($config){
        if (!self::$dbInstance){
            self::$dbInstance = new dbConnection($config);
        }
        
        return self::$dbInstance;
    }
}
