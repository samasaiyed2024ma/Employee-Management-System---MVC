<?php

namespace Ems\Models;

use Ems\Connect\Connection;
use PDO;

class Employee
{
    private $conn;
    private $limit = 5;
    private $total_records;

    public function __construct()
    {
        $this->conn = new Connection();
    }

    /**
     * @return all employee records
     */
    public function getAllRecords(): array
    {
        $sql = "SELECT * FROM `tbl_emp`";
        $statement = $this->conn->query($sql);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->total_records = $statement->rowCount();
        return $results;
    }

    /**
     * @return employee records by id
     */
    public function getRecordById(int $eid): array
    {
        $sql = "SELECT * FROM `tbl_emp` WHERE eid = :eid";
        $statement = $this->conn->prepare($sql);
        $statement->execute([
            ':eid' => $eid
        ]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    /**
     * query for insert data in database 
     */
    public function insertData(array $data): mixed
    {
        $insert = "INSERT INTO `tbl_emp`(`first_name`, `last_name`, `email`, `phone`, `gender`, `birthdate`, `qualification`, `image`, `about_emp`) VALUES (:fname, :lname, :email, :phone, :gender, :birthdate, :qualification, :image, :aboutemp)";
        $statement = $this->conn->prepare($insert);
        $result = $statement->execute([
            ':fname' => $data['firstname'],
            ':lname' => $data['lastname'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':gender' => $data['gender'],
            ':birthdate' => $data['birthdate'],
            ':qualification' => $data['qualification'],
            ':image' => $data['image'],
            ':aboutemp' => $data['about_emp']
        ]);
        return $result;
    }

    /**
     * query for delete data 
     */
    public function deleteData(int $eid): void
    {
        $delete = "DELETE FROM `tbl_emp` WHERE eid = :eid";
        $statement = $this->conn->prepare($delete);
        $statement->execute([
            ':eid' => $eid
        ]);
    }

    /**
     * query for update data
     */
    public function updateData(array $data): mixed
    {
        $update = "UPDATE `tbl_emp` SET `first_name`= :fname, `last_name`= :lname, `email`= :email, `phone`= :phone, `gender`= :gender, `birthdate`= :birthdate, `qualification`= :qualification, `image`=:image,`about_emp`=:about_emp WHERE eid = :eid";
        $statement = $this->conn->prepare($update);
        $result = $statement->execute([
            ':eid' => $data['eid'],
            ':fname' => $data['firstname'],
            ':lname' => $data['lastname'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':gender' => $data['gender'],
            ':birthdate' => $data['birthdate'],
            ':qualification' => $data['qualification'],
            ':image' => $data['image'],
            ':about_emp' => $data['about_emp']
        ]);
        return $result;
    }

    /**
     * get current page number
     */
    public function current_page(): int
    {
        $current_page = isset($_GET['page']) && is_numeric($_GET['page']) ?  $_GET['page'] : 1;
        filter_var($current_page, FILTER_SANITIZE_NUMBER_INT);
        return $current_page;
    }

    /**
     * @return limited number of records
     */
    public function getLimitedData(): array
    {
        $start = 0;
        if ($this->current_page() > 1) {
            $start = ($this->current_page() * $this->limit) - $this->limit;
        }
        $sql = "SELECT * FROM `tbl_emp` LIMIT $start, $this->limit";
        $statement =   $this->conn->prepare($sql);
        $statement->execute();
        $result =  $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * get pagination number
     */
    public function getPaginationNumber(): float
    {
        $total_pages = ceil($this->total_records / $this->limit);
        return $total_pages;
    }
}
