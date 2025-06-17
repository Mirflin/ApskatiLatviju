<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seazon_group extends Model
{
    protected $guarded = [];
    protected $table = 'seazon_groups';
    protected $fillable = ['name'];

    public function travels()
    {
        return $this->hasMany(Travel::class, 'seazon_id');
    }
}