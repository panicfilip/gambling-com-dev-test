<?php

namespace App\Helpers;

class DistanceCalculator
{
    protected float $earthRadius = 6371; // in km

    public function calculate(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        $angle = acos(
            sin($lat1) * sin($lat2) +
            cos($lat1) * cos($lat2) * cos($lon2 - $lon1)
        );

        return $this->earthRadius * $angle;
    }
}
