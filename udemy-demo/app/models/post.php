<?php

namespace app\models;
use PDO;


class Post extends \core\Model{

    public static function getAll(){
        // $host='localhost';
        // $dbname='php';
        // $username='phpapp';
        // $password='phpapp';

        // try{
        //     $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8;",$username,$password);
        //     $stmt = $db->query('select id, title, content from posts order by created_at');
    
        //     $results = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        //     return $results;
        // }
        // catch(PDOException $e){
        //     echo '<pre>'.$e->getMessage().'</pre>';
        // }

        try{
            $db = static::getDB();

            $stmt = $db->query('select id, title, content from posts order by created_at');
        
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);    
            return $results;
        }catch (PDOException $e){
            echo $e->getMessage();
        }


    }

}

?>