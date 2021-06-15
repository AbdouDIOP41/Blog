<?php

namespace App;

use \PDO;

class ConnectionDB {

    public static function getPDO() : PDO {

        return new PDO('mysql:host=localhost;dbname=blog', 'root','root',[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

    }
}



    
