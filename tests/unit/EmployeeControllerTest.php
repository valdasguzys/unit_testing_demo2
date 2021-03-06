<?php declare(strict_types=1);



use Controller\EmployeeController;
use Faker\Factory;
use Model\Employee;
use PHPUnit\Framework\TestCase;
use Repository\EmployeeRepository;
use function PHPUnit\Framework\assertEquals;

class EmployeeContollerTest extends TestCase {

    // test with database
    public function test1() {
        //given
        //$employeeRepository takes data from database
        $employeeRepository = new EmployeeRepository();
        $employeeController = new EmployeeController($employeeRepository);
        //when
        $res = $employeeController->getAllJson(); 
        //then
        assertEquals('[{"id":"1","name":"Petras"},{"id":"2","name":"Jonas"}]', $res);
    }

    //stub test
    public function test2() {
        $stub = $this->createStub(EmployeeRepository::class);
        $stub->method('getAll')->willReturn(array(new Employee(1, "Petras"), new Employee(2, "Jonas")));
        $employeeController = new EmployeeController($stub);

        $res = $employeeController->getAllJson(); 

        assertEquals('[{"id":1,"name":"Petras"},{"id":2,"name":"Jonas"}]', $res);
    }

    //mock test
    public function testGetAllJsonReturnsJson() {
        // $mock = $this->getMockBuilder(EmployeeRepository::class)->getMock();
        // $employeeController = new EmployeeController($mock);
        // $mock->expects($this->exactly(1))->method('getAll')->willReturn(array(new Employee(1, "Petras"), new Employee(2, "Jonas")));

        // $res = $employeeController->getAllJson(); 

        // assertEquals('[{"id":1,"name":"Petras"},{"id":2,"name":"Jonas"}]', $res); 
        //---------------------------------

        // data created with faker library
        // $faker = Factory::create();
        // $name1 = $faker->name();
        // $name2 = $faker->name();

        // $mock = $this->getMockBuilder(EmployeeRepository::class)->getMock();
        // $employeeController = new EmployeeController($mock);
        // $mock->expects($this->exactly(1))
        //     ->method('getAll')
        //     ->willReturn(array(
        //         new Employee(1, $name1),
        //         new Employee(1, $name2)
        //     ));
        // $res = $employeeController->getAllJson();
        // assertEquals('[{"id":1,"name":"' . $name1 . '"},{"id":1,"name":"' . $name2 . '"}]', $res);
        
        //a bit more complicated faker example
        $faker = Factory::create();
        $employees = array();
        for ($i=0; $i < 10; $i++ )
            array_push($employees, new Employee($i, $faker->name()));
        $mock = $this->getMockBuilder(EmployeeRepository::class)->getMock();
        $employeeController = new EmployeeController($mock);
            $mock->expects($this->exactly(1))
                ->method('getAll')
                ->willREturn($employees);
        
        $res = $employeeController->getAllJson();
        assertEquals(json_encode($employees), $res);

    }
    

    //stub test
    public function testStub() {
        $stub = $this->createStub(EmployeeRepository::class);
        $stub->method('getAll')->willReturn(array(new Employee(1, "Petras"), new Employee(2, "Jonas")));
        $employeeController = new EmployeeController($stub);

        $res = $employeeController->getAllJsonWithMetaInformation(); 

        assertEquals('{"employees":[{"id":1,"name":"Petras"},{"id":2,"name":"Jonas"}],"count":2}', $res); 
    }

    
    //mock test
    public function testGetAllJsonWithMetaReturnsJson() {
        $mock = $this->getMockBuilder(EmployeeRepository::class)->getMock();
        $employeeController = new EmployeeController($mock);
        $mock->expects($this->exactly(1))->method('getAll')->willReturn(array(new Employee(1, "Petras"), new Employee(2, "Jonas")));

        $res = $employeeController->getAllJsonWithMetaInformation(); 

        assertEquals('{"employees":[{"id":1,"name":"Petras"},{"id":2,"name":"Jonas"}],"count":2}', $res); 
    }

}