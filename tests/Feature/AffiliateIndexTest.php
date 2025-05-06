<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AffiliateIndexTest extends TestCase
{
    public function test_affiliates_within_100km_are_displayed()
    {
        Storage::fake();
        Storage::put('affiliates.txt', implode("\n", [
            json_encode([
                'affiliate_id' => 1,
                'name' => 'Alice',
                'latitude' => 53.339428,
                'longitude' => -6.257664
            ]),
            json_encode([
                'affiliate_id' => 2,
                'name' => 'Bob',
                'latitude' => 52.986375,
                'longitude' => -6.043701
            ]),
            json_encode([
                'affiliate_id' => 3,
                'name' => 'Charlie',
                'latitude' => 51.92893,
                'longitude' => -10.27699
            ]),
        ]));

        $this->get('/')
            ->assertStatus(200)
            ->assertSeeText('Alice')
            ->assertSeeText('Bob')
            ->assertDontSeeText('Charlie');
    }
}
