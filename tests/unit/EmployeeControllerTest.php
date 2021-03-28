<?php declare(strict_types=1);



use Controller\EmployeeController;
use Model\Employee;
use PHPUnit\Framework\TestCase;
use Repository\EmployeeRepository;
use function PHPUnit\Framework\assertEquals;

class EmployeeContollerTest extends TestCase {

    public function test1() {
        //given
        //$employeeRepository = new EmployeeRepository();
        $stub = $this->createStub(EmployeeRepository::class);
        $stub->method('getAll')->willReturn(array(new Employee(1, "Petras"), new Employee(2, "Jonas")));

        $employeeController = new EmployeeController($stub);

        //when
        $res = $employeeController->getAllJson(); 

        //then

        assertEquals('[{"id":1,"name":"Petras"},{"id":2,"name":"Jonas"}]', $res);
    }
}