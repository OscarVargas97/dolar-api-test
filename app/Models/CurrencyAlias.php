<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyAlias extends Model
{
    use HasFactory;

    protected $fillable = ['alias', 'currency_type_id'];

    public function currencyType()
    {
        return $this->belongsTo(CurrencyType::class);
    }
}