<?php 

namespace Controller;

use Repository\EmployeeRepository;

class EmployeeController {
    private $employeeRepository;

    public function __construct(EmployeeRepository $er){
        $this->employeeRepository = $er;
    }

    public function getAll(){

    }
 
    public function getAllById(){ 

    }

    public function getAllJson() : string {
        return json_encode($this->employeeRepository->getAll());
    }

    public function getAllJsonWithMetaInformation(){
        $employees = $this->employeeRepository->getAll();
        return json_encode(['employees' => $employees, 'count' => count($employees)]);
    }

    // public function getAllJsonWithMetaInformation(){
    //     $employees = $this->employeeRepository->getAll();
    //     $count = ['count' => count($employees)];
    //     return json_encode(array($employees, $count));
    // }

}

