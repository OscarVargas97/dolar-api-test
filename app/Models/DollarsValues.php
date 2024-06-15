<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DollarsValues extends Model
{
    use HasFactory;

    protected $fillable = ['value', 'type_id'];

    public function currencyType()
    {
        return $this->belongsTo(CurrencyType::class, 'type_id');
    }

    public function dollars()
    {
        return $this->hasMany(Dollars::class, 'value_id');
    }
}