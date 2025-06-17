<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Travel extends Model
{
    use SoftDeletes;

    protected $table = 'travel';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'road_marks', 'city', 'image', 'description', 'price', 'seazon_id', 'spot_count', 'time_term'];

    public function getImageUrlAttribute()
    {
        $imagePath = 'travels/' . $this->image;
        return $this->image && \Storage::disk('public')->exists($imagePath)
            ? asset('storage/' . $imagePath)
            : asset('no-image.png');
    }

    public function formattedTimeTerm()
    {
        return $this->time_term ? \Carbon\Carbon::parse($this->time_term)->timezone(config('app.timezone'))->format('Y-m-d') : '';
    }

    public function season()
    {
        return $this->belongsTo(SeazonGroup::class, 'seazon_id');
    }

    public function checks()
    {
        return $this->hasMany(TravelCheck::class);
    }
}