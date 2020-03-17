<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckInUsage extends Model
{
    /**
     * @var string
     */
    protected $table = 'check_in_usages';

    /**
     * @var array
     */
    protected $fillable = [
        'check_in_id',
        'check_in_category_id'
    ];

    /*
    |------------------------------------------------------------------------------------
    | Relations
    |------------------------------------------------------------------------------------
    */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function checkIn()
    {
        return $this->belongsTo(CheckIn::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function checkInCategory()
    {
        return $this->belongsTo(CheckInCategory::class);
    }
}
