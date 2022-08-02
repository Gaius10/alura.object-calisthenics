<?php

namespace Alura\Calisthenics\Domain\Email;

class EmailAddress
{
    function __construct(private string $emailAddress)
    {
        if (filter_var($emailAddress, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('Invalid e-mail address');
        }
    }

    public function __toString(): string
    {
        return $this->emailAddress;
    }
}
