<?php

declare(strict_types=1);

namespace App\Distance;

final readonly class Distance implements \JsonSerializable
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

    public function jsonSerialize(): mixed
    {
       return [
           'distance' => $this->value,
           'unit' => $this->unit->value
       ];
    }
}