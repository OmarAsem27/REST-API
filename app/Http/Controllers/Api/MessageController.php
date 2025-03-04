<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewMessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(NewMessageRequest $request)
    {
        $data = $request->validated();
        $message = Message::create($data);
        if ($message) {
            return ApiResponse::sendResponse(201, 'Sent Successfully', []);
        }
        return ApiResponse::sendResponse(200, 'Message Creation Failed', []);
    }
}
