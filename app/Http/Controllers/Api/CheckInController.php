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
     * @param Request $request
     * @return string
     */
    public function store(CheckInRequest $request)
    {
        $user = \Auth::user();
        $checkIn = CheckIn::create([
            'user_id' => $user->id,
        ]);

        if (filled($request->input('checkin_category_ids'))){
            foreach ($request->input('checkin_category_ids') as $CheckinCategoryId) {
                $checkIn->checkInUsages()->create(['check_in_category_id' => $CheckinCategoryId]);
            }
        }

        return response()->json(new CheckInResource($checkIn));
    }
}
