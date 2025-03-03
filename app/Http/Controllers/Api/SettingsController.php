<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $settings = Setting::find(4);
        if ($settings)
            return ApiResponse::sendResponse(
                200,
                'Setting Retrieved Successfully',
                new SettingResource($settings)
            );

        return ApiResponse::sendResponse(
            200,
            'Setting Not Found',
            []
        );
    }
}
