<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DaftarJadwalUjianRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'payment_type' => 'required|in:bca,bri,bni,ovo,shopee pay,link aja,cod'
        ];
    }

    public function messages(): array
    {
        return [
            'payment_type.required' => 'Metode pembayaran wajib dipilih',
            'payment_type.in' => 'Metode pembayaran hanya mendukung metode :values',
        ];
    }
}
