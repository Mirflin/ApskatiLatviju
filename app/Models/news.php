<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    protected $table = 'news';
    protected $dates = ['deleted_at'];
    protected $fillable = ['header', 'paragraph', 'image'];

    public function getImageUrlAttribute()
    {
        $imagePath = 'news/' . $this->image;
        return $this->image && \Storage::disk('public')->exists($imagePath)
            ? asset('storage/' . $imagePath)
            : asset('no-image.png');
    }
}