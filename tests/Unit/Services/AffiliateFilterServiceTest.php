<?php

namespace Tests\Unit\Services;

use App\Services\AffiliateFilterService;
use App\Helpers\DistanceCalculator;
use App\Services\AffiliateReaderService;
use Tests\TestCase;

class AffiliateFilterServiceTest extends TestCase
{
    public function test_it_filters_affiliates_within_100_km()
    {
        // Mock reader to return 3 affiliates
        $reader = $this->createMock(AffiliateReaderService::class);
        $reader->method('handle')->willReturn([
            ['affiliate_id' => 1, 'name' => 'Alice', 'latitude' => 53.5, 'longitude' => -6.2],
            ['affiliate_id' => 2, 'name' => 'Bob', 'latitude' => 53.0, 'longitude' => -6.5],
            ['affiliate_id' => 3, 'name' => 'Charlie', 'latitude' => 51.0, 'longitude' => -9.0],
        ]);

        // Mock calculator to return distances
        $calculator = $this->createMock(DistanceCalculator::class);
        $calculator->method('calculate')
            ->willReturnMap([
                [53.3340285, -6.257664, 53.5, -6.2, 10],   // Alice - within 100km
                [53.3340285, -6.257664, 53.0, -6.5, 50],   // Bob - within 100km
                [53.3340285, -6.257664, 51.0, -9.0, 250],  // Charlie - outside 100km
            ]);

        $service = new AffiliateFilterService($reader, $calculator);
        $result = $service->handle();

        $this->assertCount(2, $result);
        $this->assertEquals([
            ['affiliate_id' => 1, 'name' => 'Alice'],
            ['affiliate_id' => 2, 'name' => 'Bob'],
        ], $result);
    }
}
