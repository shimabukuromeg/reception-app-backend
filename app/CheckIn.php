<?php

namespace App;

use App\Http\Requests\CheckInRequest;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    /**
     * @var string
     */
    protected $table = 'check_ins';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
    ];

    /*
    |------------------------------------------------------------------------------------
    | Relations
    |------------------------------------------------------------------------------------
    */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checkInUsages()
    {
        return $this->hasMany(CheckInUsage::class);
    }

    /*
    |------------------------------------------------------------------------------------
    | Method
    |------------------------------------------------------------------------------------
    */
    /**
     * @param CheckInRequest $request
     * @return CheckIn
     */
    public static function createWithCheckInUsage(CheckInRequest $request): CheckIn
    {
        $checkIn = self::create([
            'user_id' => $request->user()->id,
        ]);

        if ($request->hasCheckInCategoryIds()){
            foreach ($request->input('checkin_category_ids') as $CheckinCategoryId) {
                $checkIn->checkInUsages()->create(['check_in_category_id' => $CheckinCategoryId]);
            }
        }

        return $checkIn;
    }
}
