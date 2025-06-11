<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class Review extends Model
{
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
