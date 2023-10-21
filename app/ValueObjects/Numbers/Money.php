<?php

namespace App\ValueObjects\Numbers;

class Money
{
    public function __construct(private readonly ?float $value)
    {
    }

    public static function from(?float $value): self
    {
        return new static($value);
    }

    public function format(): string
    {
        if (!$this->value) {
            return '$0';
        }

        return '$' . number_format($this->value, 2);
    }
}
