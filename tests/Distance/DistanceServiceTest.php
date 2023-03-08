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
        $distanceInMeters = ($firstDistanceValue + ($secondDistanceValue * DistanceService::TO_METER_FACTORS[Unit::YARDS->value]));

        self::assertSame(
            $this->toDecimal($distanceInMeters),
            $this->toDecimal($distanceService->calculate($firstDistance, $secondDistance, $returnUnit)->getValue())
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
        $distanceInYards = ($secondDistanceValue + $firstDistanceValue * DistanceService::TO_YARD_FACTORS['METER']);

        self::assertSame(
            $this->toDecimal($distanceInYards),
            $this->toDecimal($distanceService->calculate($firstDistance, $secondDistance, $returnUnit)->getValue())
        );
    }

    private function toDecimal(float $value, int $decimal = 2): string
    {
        return number_format($value, $decimal);
    }
}