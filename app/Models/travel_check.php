<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class travel_check extends Model
{
    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function travel() {
        return $this->belongsTo(Travel::class);
    }
}
