<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Book extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'cat_id',
        'auther_id',
        'avatar',
        'pdf',

    ];
}
