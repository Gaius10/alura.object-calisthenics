<?php

namespace Alura\Calisthenics\Domain\Student;

class FullName
{
    private string $fullName;

    function __construct(string $firstName, string $lastName)
    {
        $this->fullName = $firstName . ' ' . $lastName;
    }

    public function __toString(): string
    {
        return $this->fullName;
    }
}
