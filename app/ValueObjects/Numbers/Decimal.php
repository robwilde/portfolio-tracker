<?php

namespace App\ValueObjects\Numbers;

class Decimal
{
    public function __construct(private readonly float $value)
    {
    }

    public static function from(float $value): self
    {
        return new static($value);
    }

    public function format(): string
    {
        return number_format($this->value, 2);
    }
}
