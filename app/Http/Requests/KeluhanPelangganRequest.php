<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KeluhanPelangganRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama' => 'required|string|min:3|max:50',
            'email' => 'required|email|max:255',
            'nomor_hp' => 'nullable|regex:/^[0-9]+$/',
            'keluhan' => 'required|string|min:50|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nama.max' => 'Text too long, maximum 50 characters.',
            'nama.min' => 'Name must be at least 3 characters.',
            'nomor_hp.regex' => 'Input numeric only for phone number.',
            'keluhan.min' => 'Complaint must be at least 50 characters.',
            'keluhan.max' => 'Complaint  must not exceed 255 characters.',
        ];
    }
}
