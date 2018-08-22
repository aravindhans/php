<?php

namespace core;
use PDO;
use app\Config;

abstract class Model{

    /**
     * Fn getDB() - function to set the DB connection once and use it throughout
     */
    public static function getDB(){

        static $db = null;
        //If $db is already set, return it, else create new
        if ($db === null) {
            $db = new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_NAME.";charset=utf8;", Config::DB_USER, Config::DB_PASS);
            
            //Set error handling to exception mode for DB related errors
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $db;
    }

}

?>