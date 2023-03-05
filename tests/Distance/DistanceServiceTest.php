<?php

declare(strict_types=1);

namespace Distance;

use App\Distance\Distance;
use App\Distance\DistanceService;
use App\Distance\Unit;
use PHPUnit\Framework\TestCase;

class DistanceServiceTest extends TestCase
{
    /**
     * @test
     */
    public function itCalculatesToMeters(): void
    {
        $firstDistanceValue = random_int(0, 10) / 10;
        $secondDistanceValue = random_int(0, 10) / 10;

        $firstDistance = new Distance($firstDistanceValue, Unit::METER);
        $secondDistance = new Distance($secondDistanceValue, Unit::YARDS);
        $returnUnit = Unit::METER;

        $distanceService = new DistanceService();
        $distanceInMeters = ($firstDistanceValue + ($secondDistanceValue * DistanceService::FACTORS[Unit::YARDS->value]));

        self::assertSame(
            $distanceInMeters,
            $distanceService->calculate($firstDistance, $secondDistance, $returnUnit)->getValue()
        );
    }

    /**
     * @test
     */
    public function itCalculatesToYards(): void
    {
        $firstDistanceValue = random_int(0, 10) / 10;
        $secondDistanceValue = random_int(0, 10) / 10;

        $firstDistance = new Distance($firstDistanceValue, Unit::METER);
        $secondDistance = new Distance($secondDistanceValue, Unit::YARDS);
        $returnUnit = Unit::YARDS;

        $distanceService = new DistanceService();
        $distanceInMeters = ($secondDistanceValue + ($firstDistanceValue * DistanceService::FACTORS[Unit::YARDS->value]));

        self::assertSame(
            $distanceInMeters,
            $distanceService->calculate($firstDistance, $secondDistance, $returnUnit)->getValue()
        );
    }
}