<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // fields we allow to be mass-assigned
    protected $fillable = [
        'name',
        'email',
        'status',
    ];
}
