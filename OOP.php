<?php

interface PaymentInterface
{
    public function getSalary();
}

abstract class AbstractEmployee implements PaymentInterface
{
    private $fullName;
    private $salaryStrategy;
    private $position;

    protected function __construct(string $fullName, SalaryInterface $salaryStrategy, string $position)
    {
        $this->fullName = $fullName;
        $this->salaryStrategy = $salaryStrategy;
        $this->position = $position;
    }
    public function getSalary(): float
    {
        return $this->salaryStrategy->getSalary();
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getPosition(): string
    {
        return $this->position;
    }
}

class Developer extends AbstractEmployee
{
    private $grade = '';

    public function __construct(string $fullName, SalaryInterface $salaryStrategy)
    {
        parent::__construct($fullName, $salaryStrategy, 'Developer');
    }

    public function getPosition(): string
    {
        if ($this->grade) {
            return $this->grade.' '.parent::getPosition();
        }
        else {
            return parent::getPosition();
        }
    }

    protected function setGrade($grade): string
    {
        return $this->grade = $grade;
    }
}

class MiddleDeveloper extends Developer
{
    public function __construct(string $fullName, SalaryInterface $salaryStrategy)
    {
        parent::__construct($fullName, $salaryStrategy);
        $this->setGrade('Middle');
    }
}

class SeniorDeveloper extends Developer
{
    public function __construct(string $fullName, SalaryInterface $salaryStrategy)
    {
        parent::__construct($fullName, $salaryStrategy);
        $this->setGrade('Senior');
    }
}

class LayoutDesigner extends AbstractEmployee
{
    public function __construct(string $fullName, SalaryInterface $salaryStrategy)
    {
        parent::__construct($fullName, $salaryStrategy, 'Layout Designer');
    }
}

class Designer extends AbstractEmployee
{
    public function __construct(string $fullName, SalaryInterface $salaryStrategy)
    {
        parent::__construct($fullName, $salaryStrategy, 'Designer');
    }
}

interface SalaryInterface
{
    public function getSalary(): float;
}

class FixedSalary implements SalaryInterface {
    private $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }
    public function getSalary(): float
    {
        return $this->amount;
    }
}

class HourlySalary implements SalaryInterface {
    private $hours;
    private $amountPerHour;

    public function __construct(float $amountPerHour, float $hours)
    {
        $this->amountPerHour = $amountPerHour;
        $this->hours = $hours;
    }

    public function getSalary(): float
    {
        return $this->amountPerHour * $this->hours;
    }
}

class Team implements PaymentInterface
{
    private $employees = [];

    public function addEmployee(PaymentInterface $obj): void
    {
        $this->employees[] = $obj;
    }

    public function getSalary(): float
    {
        $result = 0;
        foreach ($this->employees as $employee) {
            $result += $employee->getSalary();
        }
        return $result;
    }
}
