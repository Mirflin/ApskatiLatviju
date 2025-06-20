<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Services_check;

class Service extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'services';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'description', 'price'];

    public function checks()
    {
        return $this->hasMany(Services_check::class);
    }
}