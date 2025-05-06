<?php

namespace App\Services;

class AffiliateReaderService
{
    public function handle(string $path): iterable
    {
        foreach (file($path) as $line) {
            $data = json_decode($line, true);

            if (!$data || !isset($data['latitude'], $data['longitude'], $data['affiliate_id'], $data['name'])) {
                continue;
            }

            yield $data;
        }
    }
}
