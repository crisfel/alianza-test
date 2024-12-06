<?php

namespace App\DTOs\Employee;

class UpdateEmployeeDTO
{
    public int $id;
    public string $name;
    public string $lastName;
    public string $phone;
    public string $identification;
    public string $address;
    public string $city;
    public string $department;
    public string $email;
    public ?int $bossID;
    public string $password;
    public array $position;
}
