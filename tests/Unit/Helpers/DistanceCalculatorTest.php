<?php

namespace Tests\Unit\Helpers;

use App\Helpers\DistanceCalculator;
use Tests\TestCase;

class DistanceCalculatorTest extends TestCase
{
    public function test_calculates_correct_distance(): void
    {
        $calculator = new DistanceCalculator();

        $distance = $calculator->calculate(
            53.3340285, -6.2535495, // Dublin
            52.986375, -6.043701, // Affiliate 1
        );

        $this->assertGreaterThan(0, $distance);
        $this->assertLessThan(100, $distance);

        $distance = $calculator->calculate(
            53.3340285, -6.2535495, // Dublin
            44.78775541270085, 20.521542991993787, // Affiliate 2
        );

        $this->assertGreaterThan(100, $distance);
    }
}
