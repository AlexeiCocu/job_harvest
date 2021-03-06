<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CV extends Model
{
    use HasFactory;

    protected $table = 'c_v_s';

    protected $fillable = [
        'name',
        'address',
        'education',
        'work',
        'experience',
        'stack'
    ];
}
