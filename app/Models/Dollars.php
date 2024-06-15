<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Dollars extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'value',
        'type_id',
    ];

    public function currencyType()
    {
        return $this->belongsTo(CurrencyType::class, 'type_id');
    }
}