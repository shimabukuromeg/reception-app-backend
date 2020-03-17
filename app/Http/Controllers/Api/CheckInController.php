<?php

namespace App\Http\Controllers\Api;

use App\CheckIn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Http\Resources\CheckInResource;
use App\Http\Requests\CheckInRequest;

class CheckInController extends Controller
{
    /**
     * @param CheckInRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CheckInRequest $request)
    {
        $checkIn = CheckIn::createWithCheckInUsage($request);
        return response()->json(new CheckInResource($checkIn));
    }
}
