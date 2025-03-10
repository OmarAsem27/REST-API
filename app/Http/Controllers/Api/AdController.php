<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{

    public function index()
    {
        $ads = Ad::latest()->paginate(1);
        if (count($ads) > 0) {
            if ($ads->total() > $ads->perPage()) {
                $data = [
                    'records' => AdResource::collection($ads),
                    'pagination links' => [
                        'current page' => $ads->currentPage(),
                        'per page' => $ads->perPage(),
                        'total' => $ads->total(),
                        'links' => [
                            'first' => $ads->url(1),
                            'last' => $ads->url($ads->lastPage()),
                        ]
                    ]
                ];
            } else {
                $data = AdResource::collection($ads);
            }
            return ApiResponse::sendResponse(
                200,
                'Ads Retrieved Successfully',
                $data
                // $ads
                // AdResource::collection($ads)
            );
        }
        return ApiResponse::sendResponse(200, 'No Ads Available', []);
    }
}
