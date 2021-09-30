<?php

class DataBase{

    public static function connect(){
        $link = new PDO('mysql:host=localhost;dbname=apivanilla', 'root', '');
        $link->exec('set names utf8');
        return $link;
    }
    
}