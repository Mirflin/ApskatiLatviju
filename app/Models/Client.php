<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\travel_check;

class Client extends Model
{
    use SoftDeletes;

    protected $table = 'clients';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'surname', 'email', 'phone', 'comment'];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function travelChecks()
    {
        return $this->hasMany(travel_check::class);
    }
}