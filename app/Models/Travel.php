<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Travel extends Model
{
    use SoftDeletes;

    protected $table = 'travel'; // Указываем правильное имя таблицы
    protected $dates = ['deleted_at', 'time_term'];
    protected $fillable = ['group_id', 'name', 'road_marks', 'city', 'image', 'description', 'price', 'seazon_id', 'spot_count', 'time_term'];

    public function getImageUrlAttribute()
    {
        $imagePath = 'travels/' . $this->image;
        return $this->image && \Storage::disk('public')->exists($imagePath)
            ? asset('storage/' . $imagePath)
            : asset('no-image.png');
    }

    public function formattedTimeTerm()
    {
        return \Carbon\Carbon::parse($this->time_term)->format('d.m.Y');
    }

    public function season()
    {
        return $this->belongsTo(Season::class, 'seazon_id');
    }
}