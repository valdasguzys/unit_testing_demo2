<?php

namespace Repository;

use Model\Employee;

class EmployeeRepository { 
    private $server; 
    private $username; 
    private $password; 
    private $database; 
    private $conn;

    public function __construct(){
        $this->server = "localhost";
        $this->username = "root";
        $this->password = "mysql";
        $this->database = "qademo";
        $this->conn = mysqli_connect($this->server, $this->username, $this->password, $this->database);
    }
     
    public function getAll() : array {
        $result = mysqli_query($this->conn, "SELECT id, name FROM Employee");
        
        $employees = array();
        if (mysqli_num_rows($result) > 0)
            while($row = mysqli_fetch_assoc($result)){
                array_push($employees, new Employee($row['id'], $row['name']));
            }
        mysqli_close($this->conn);
        return $employees;
    }

    public function getById(){

    }

    public function save(Employee $e){

    }
}
