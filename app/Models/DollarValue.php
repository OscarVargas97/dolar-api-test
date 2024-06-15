<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DollarValue extends Model
{
    use HasFactory;

    protected $table = 'dollars_values';

    protected $fillable = ['value', 'dollar_id'];

    public $timestamps = false;
}