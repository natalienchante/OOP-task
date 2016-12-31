<?php

require 'OOP.php';

$team = new Team();
$team->addEmployee(new Designer('NS', new FixedSalary(3000)));
$team->addEmployee(new SeniorDeveloper('NS', new HourlySalary(10, 60)));
$team->addEmployee(new MiddleDeveloper('NS', new FixedSalary(1000)));
$team->addEmployee(new MiddleDeveloper('NS', new FixedSalary(1000)));
$team->addEmployee(new LayoutDesigner('NS', new HourlySalary(5, 120)));
echo "Required sum is ".$team->getSalary().".\n";