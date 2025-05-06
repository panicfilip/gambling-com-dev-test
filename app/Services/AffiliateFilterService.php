<?php

namespace App\Services;

use App\Helpers\DistanceCalculator;
use Illuminate\Support\Facades\Storage;

class AffiliateFilterService
{
    const int MAX_DISTANCE_KM = 100;
    const float DUBLIN_OFFICE_LATITUDE = 53.3340285;
    const float DUBLIN_OFFICE_LONGITUDE = -6.257664;

    public function __construct(
        protected AffiliateReaderService $reader,
        protected DistanceCalculator $calculator
    )
    {}

    public function handle(): array
    {
        $results = [];
        foreach ($this->reader->handle(Storage::path('affiliates.txt')) as $affiliate) {
            $distance = $this->calculator->calculate(
                self::DUBLIN_OFFICE_LATITUDE,
                self::DUBLIN_OFFICE_LONGITUDE,
                $affiliate['latitude'],
                $affiliate['longitude']
            );

            if ($distance <= self::MAX_DISTANCE_KM) {
                $results[] = [
                    'affiliate_id' => $affiliate['affiliate_id'],
                    'name' => $affiliate['name'],
                ];
            }
        }

        usort($results, fn($a, $b) => $a['affiliate_id'] <=> $b['affiliate_id']);

        return $results;
    }
}
