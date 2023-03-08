<?php

declare(strict_types=1);

namespace App\Distance;

class DistanceService implements DistanceServiceInterface
{
    public const TO_METER_FACTORS = [
        'METER' => 1,
        'YARD' => 0.9144,
    ];

    public const TO_YARD_FACTORS = [
        'YARD' => 1,
        'METER' => 1.09361,
    ];

    public function calculate(Distance $firstDistance, Distance $secondDistance, Unit $unit): Distance
    {
        $sumInMeters = ($firstDistance->getValue() * self::TO_METER_FACTORS[$firstDistance->getUnit()->value]) +
            ($secondDistance->getValue() * self::TO_METER_FACTORS[$secondDistance->getUnit()->value]);

        if (Unit::METER->value === $unit->value) {
            return new Distance($sumInMeters, $unit);
        }

        return new Distance($sumInMeters * self::TO_YARD_FACTORS['METER'], $unit);
    }
}