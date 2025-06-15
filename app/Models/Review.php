<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    protected $table = 'reviews';
    protected $dates = ['deleted_at'];
    protected $fillable = ['travel_id', 'client_id', 'review'];

    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}