<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class services_check extends Model
{
    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
