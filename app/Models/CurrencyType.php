<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function aliases()
    {
        return $this->hasMany(CurrencyAlias::class);
    }

    public function dollarValues()
    {
        return $this->hasMany(DollarValue::class, 'type_id');
    }
}