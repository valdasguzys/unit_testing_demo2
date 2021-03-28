<?php declare(strict_types=1);

use Controller\EmployeeController;
use PHPUnit\Framework\TestCase;
use Repository\EmployeeRepository;
use function PHPUnit\Framework\assertEquals;

class EmployeeContollerTest extends TestCase {

    public function test1() {
        //given
        $employeeRepository = new EmployeeRepository();
        $employeeController = new EmployeeController($employeeRepository);

        //when
        $res = $employeeController->getAllJson(); 

        //then

        assertEquals('[{"id":"1","name":"Petras"},{"id":"2","name":"Jonas"}]', $res);
    }
}