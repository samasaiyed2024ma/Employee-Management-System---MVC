<?php

namespace Ems\Models;

use Ems\Connect\Connection;
use PDO;

class Admin
{
    private $conn;

    public function __construct()
    {
        $this->conn = new Connection();
    }

    /**
     * @return all records from admin table
     */
    public function getAdminList(): array
    {
        $sql = "SELECT * FROM `tbl_admin`";
        $statement = $this->conn->query($sql);

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @return records by E-mail id
     */
    public function getRecordByEmail(string $email): array
    {
        $sql = "SELECT * FROM `tbl_admin` WHERE email = :email";
        $statement = $this->conn->prepare($sql);

        $statement->execute([
            ':email' => $email
        ]);

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    /**
     * store admin data
     */
    public function insertAdminData(array $data): mixed
    {
        $insert = "INSERT INTO `tbl_admin` (`first_name`, `last_name`, `email`, `password`) VALUES (:fname, :lname, :email, :password)";
        $statement = $this->conn->prepare($insert);
        $result = $statement->execute([
            ':fname' => $data['first_name'],
            ':lname' => $data['last_name'],
            ':email' => $data['email'],
            ':password' => $data['password']
        ]);
        return $result;
    }
}
