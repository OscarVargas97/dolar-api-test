<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dollars extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'value_id'];

    public function dollarValue()
    {
        return $this->belongsTo(DollarsValues::class, 'value_id');
    }
}