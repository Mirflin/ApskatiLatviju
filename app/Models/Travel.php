<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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

    public function getImageUrlAttribute()
    {
        $path = 'travels/' . $this->image;

        if ($this->image && Storage::disk('public')->exists($path)) {
            return asset('storage/' . $path);
        }

        return asset('no-image.png');
    }

    public function feedbacks()
    {
        return $this->hasMany(\App\Models\Feedbacks::class)->latest();
    }
}