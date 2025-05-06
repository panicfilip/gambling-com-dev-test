<?php

namespace App\Http\Controllers;

use App\Services\AffiliateFilterService;
use Illuminate\View\View;

class AffiliateController extends Controller
{
    public function index(AffiliateFilterService $service): View
    {
        $affiliates = $service->handle();

        return view('affiliates', compact('affiliates'));
    }
}
