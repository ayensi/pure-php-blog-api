<?php

class Database
{
    /* DB Params */
    private $host = 'ecommerce-db-1';
    private $dbname = 'blog';
    private $dbuser = 'postgres';
    private $dbpassword = 'password';
    private $conn;

    /* DB Connection */

    public function connect(){
        $this->conn=null;

        try{
            $this->conn = new PDO('pgsql:host='.$this->host.';dbname='.$this->dbname,$this->dbuser,$this->dbpassword);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e){
            echo 'Connection error:' . $e->getMessage();
        }
        return $this->conn;
    }

}