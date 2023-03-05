<?php

declare(strict_types=1);

namespace App\Distance;

final readonly class Distance
{
    public function __construct(
        private float $value,
        private Unit $unit) {}

    public function getValue(): float
    {
        return $this->value;
    }

    public function getUnit(): Unit
    {
        return $this->unit;
    }
}