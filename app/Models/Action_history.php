<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Action_history extends Model
{
    // protected $fillable = [
    //     'user_id',
    //     'action',
    //     'status_id',
    // ];

    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }
}