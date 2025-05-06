<?php

namespace App\Services;

use App\Helpers\DistanceCalculator;

class AffiliateFilterService
{
    const int MAX_DISTANCE_KM = 100;
    const float DUBLIN_OFFICE_LATITUDE = 53.3340285;
    const float DUBLIN_OFFICE_LONGITUDE = -6.257664;

    protected string $affiliatesFilePath;

    public function __construct(
        protected AffiliateReaderService $reader,
        protected DistanceCalculator $calculator,
    )
    {
        $this->affiliatesFilePath = config('affiliates.file_url');
    }

    public function handle(): array
    {
        $results = [];
        foreach ($this->reader->handle($this->affiliatesFilePath) as $affiliate) {
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
