<?php

/*
* Database class, It will be singleton class
* only one instance is available througout the script
*/

class Database extends PDO
{
    public function __construct()
    {

        return parent::__construct(DBTYPE.":host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPASS,
            array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    }
}