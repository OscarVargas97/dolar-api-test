<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dollar extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'dollar_value'];

    public function dollarValue()
    {
        return $this->belongsTo(DollarValue::class, 'dollar_value');
    }
}