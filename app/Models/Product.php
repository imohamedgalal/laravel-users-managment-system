<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'code';
    public $incrementing = false;

    protected $fillable = [
        'code',
        'name',
        'version',
    ];
}
