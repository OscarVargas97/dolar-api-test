<?php

namespace App\Http\Api\Requests;
use Illuminate\Foundation\Http\FormRequest;

class DollarRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'start_date' => 'date|nullable',
            'end_date' => 'date|nullable',
        ];
    }
}