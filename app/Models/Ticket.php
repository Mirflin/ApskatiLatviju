<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Ticket extends Model
{
    // use for tests and seeders
    use HasFactory;

    protected $fillable = [
        'email',
        'content',
    ];
}
