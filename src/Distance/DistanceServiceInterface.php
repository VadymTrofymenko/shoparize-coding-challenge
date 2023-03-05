<?php

declare(strict_types=1);

namespace App\Distance;

interface DistanceServiceInterface
{
    public function calculate(
        Distance $firstDistance,
        Distance $secondDistance,
        Unit $unit,
    ): Distance;
}