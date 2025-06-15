<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class services_check extends Model
{
    use SoftDeletes;

    protected $table = 'services_checks';
    protected $dates = ['deleted_at'];
    protected $fillable = ['service_id', 'client_id', 'code'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}