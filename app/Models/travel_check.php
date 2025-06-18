<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Travel_check extends Model
{
    use SoftDeletes;

    protected $table = 'travel_checks';
    protected $dates = ['deleted_at'];
    protected $fillable = ['travel_id', 'client_id', 'code', 'people_count'];

    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}