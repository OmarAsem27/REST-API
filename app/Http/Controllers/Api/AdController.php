<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdRequest;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function latest()
    {
        $ads = Ad::latest()->take(2)->get();

        if (count($ads) > 0) {
            return ApiResponse::sendResponse(200, 'Latest Ads Retrieved Successfully', AdResource::collection($ads));
        }
        return ApiResponse::sendResponse(200, 'No Ads Available', []);
    }

    public function domain($domain_id)
    {
        $ads = Ad::where('domain_id', $domain_id)->latest()->get();
        if (count($ads) > 0) {
            return ApiResponse::sendResponse(200, "Domain's Ads Retrieved Successfully", AdResource::collection($ads));
        }
        return ApiResponse::sendResponse(200, 'No Ads available in this domain ', []);
    }

    public function search(Request $request)
    {
        $word = $request->input('search') ?? null;

        $ads = Ad::when($word != null, function ($q) use ($word) {
            $q->where('title', 'LIKE', "%" . $word . "%");
        })->latest()->get();
        if (count($ads) > 0) {

            return ApiResponse::sendResponse(200, "Search Completed Successfully", AdResource::collection($ads));
        }
        return ApiResponse::sendResponse(200, 'No Matching Data', []);
    }

    public function create(AdRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $data['slug'] = Str::slug($request->title);
        $record = Ad::create($data);
        if ($record)
            return ApiResponse::sendResponse(201, 'Ad Created Succfully', new AdResource($record));
    }

    public function update(AdRequest $request, $ad_id)
    {
        $ad = Ad::findOrFail($ad_id);
        if ($ad->user_id != $request->user()->id) {
            return ApiResponse::sendResponse(403, "You aren't allowed to take this action", []);
        }
        $data = $request->validated();
        $data['slug'] = Str::slug($request->title);
        $record = $ad->update($data);

        if ($record)
            return ApiResponse::sendResponse(201, 'Your Ad Updated Succfully', new AdResource($ad));
    }

    public function delete(Request $request, $ad_id)
    {
        $ad = Ad::findOrFail($ad_id);

        if ($ad->user_id != $request->user()->id) {
            return ApiResponse::sendResponse(403, "You aren't allowed to take this action", []);
        }
        $success = $ad->delete();
        if ($success)
            return ApiResponse::sendResponse(200, "Your Ad Deleted Successfully", []);

    }


    public function myads(Request $request)
    {
        $ads = Ad::where('user_id', $request->user()->id)->get();
        if (count($ads) > 0) {
            return ApiResponse::sendResponse(200, "Your Ads Retrieved Successfully", AdResource::collection($ads));
        }

        return ApiResponse::sendResponse(200, "You don't have any ads", []);
    }


}
