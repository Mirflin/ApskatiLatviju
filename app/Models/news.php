<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    public function getImageUrlAttribute()
    {
        $path = 'news/' . $this->image;
        if ($this->image && Storage::disk('public')->exists($path)) {
            return asset('storage/' . $path);
        }
        return asset('no-image.png');
    }
}
