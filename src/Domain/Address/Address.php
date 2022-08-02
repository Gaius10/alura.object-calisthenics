<?php

namespace Alura\Calisthenics\Domain\Address;

class Address
{
    function __construct(
        public readonly string $street,
        public readonly string $number,
        public readonly string $province,
        public readonly string $city,
        public readonly string $state,
        public readonly string $country,
        public readonly string $postalCode
    ) {}

    public static function fromPostalCode(string $postalCode): self
    {
        // @todo
        return new self(
            '', '', '', '', '', '', ''
        );
    }
}
