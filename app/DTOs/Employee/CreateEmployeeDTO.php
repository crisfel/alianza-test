<?php

namespace App\DTOs\Employee;

class CreateEmployeeDTO
{
    public string $name;
    public string $lastName;
    public string $phone;
    public string $identification;
    public string $address;
    public string $city;
    public string $department;
    public string $email;
    public string $password;
    public string $role;
    public ?int $bossID;
    public array $position;
}
