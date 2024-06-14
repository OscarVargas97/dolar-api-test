<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dollar extends Model
{
    use HasFactory;
    protected $table = 'dollar';
    protected $fillable = [
        'date', 
        'value'
    ];
    public $timestamps = false;
}
