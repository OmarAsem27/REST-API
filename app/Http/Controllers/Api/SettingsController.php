<?php

namespace App\Http\Controllers\Api;

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
        $settings = Setting::get();
        return SettingResource::collection($settings);
        // return new SettingResource($settings); // for a single record
        // return response()->json(new SettingResource($settings)); // for a single record and without cancelling the wrapping
    }
}
