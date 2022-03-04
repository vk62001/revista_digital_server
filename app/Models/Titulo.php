<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Titulo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'file_path',
        'description',
        'image_path'

    ];
}
