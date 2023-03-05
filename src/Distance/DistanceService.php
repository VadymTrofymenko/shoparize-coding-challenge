<?php

declare(strict_types=1);

namespace App\Distance;

class DistanceService implements DistanceServiceInterface
{
    public const FACTORS = [
        'METER' => 1,
        'YARD' => 0.9144,
    ];

    public function calculate(Distance $firstDistance, Distance $secondDistance, Unit $unit): Distance
    {
        $sumInMeters = ($firstDistance->getValue() * self::FACTORS[$firstDistance->getUnit()->value]) +
            ($secondDistance->getValue() * self::FACTORS[$secondDistance->getUnit()->value]);

        if (Unit::METER->value === $unit->value) {
            return new Distance($sumInMeters, $unit);
        }

        return new Distance($sumInMeters * self::FACTORS[$unit->value], $unit);
    }
}