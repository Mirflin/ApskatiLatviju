<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Travel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'road_marks', 'country', 'image',
        'description', 'price', 'spot_count', 'time_term'
    ];

    public function formattedTimeTerm($format = 'd.m')
    {
        if (!$this->time_term) {
            return null;
        }

        return Carbon::parse($this->time_term)->format($format);

    }
}