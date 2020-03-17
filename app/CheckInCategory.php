<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckInCategory extends Model
{
    /**
     * @var string
     */
    protected $table = 'check_in_categories';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}
