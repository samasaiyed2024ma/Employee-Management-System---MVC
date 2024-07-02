<?php

namespace Ems\Connect;
use PDO, PDOException;

class Connection{
    protected $dsn;
    protected $errors;
    protected $conn;
    protected string $host='localhost';
    protected string $dbname = 'employee';
    protected string $username = 'monarch';
    protected string $password = 'monarch';

    public function __construct(){
        $this->dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=UTF8";

        try{
            $this->errors = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]; 
            $this->conn =  new PDO($this->dsn, $this->username, $this->password, $this->errors);
            return $this->conn;
        }
        catch(PDOEXCEPTION $e){
            die($e->getMessage());
        }
    }

    public function query($sql) : mixed{
        return $this->conn->query($sql);
    }

    public function prepare($sql) : mixed{
        return $this->conn->prepare($sql);
    }
}



?>