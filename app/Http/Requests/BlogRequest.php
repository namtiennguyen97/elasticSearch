<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{


    public function rules()
    {
        return [
            'title' => 'required',
            'content' => 'required'
        ];
    }
}
