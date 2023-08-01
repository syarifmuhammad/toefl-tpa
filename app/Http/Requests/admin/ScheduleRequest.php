<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'questionbank_id' => 'required|exists:question_banks,id',
            'tanggal' => 'required|date|after:yesterday',
            'waktu' => 'required|date_format:H:i',
            'kuota' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'questionbank_id.required' => 'Bank Soal wajib dipilih',
            'questionbank_id.exists' => 'Bank Soal tidak ditemukan',
            'tanggal.required' => 'Tanggal wajib diisi',
            'tanggal.date' => 'Format tanggal salah',
            'tanggal.after' => 'Tanggal harus sama atau lebih dari tanggal sekarang',
            'waktu.required' => 'Waktu wajib diisi',
            'waktu.date_format' => 'Format waktu salah',
            'kuota.required' => 'Kuota wajib diisi',
            'kuota.min' => 'Kuota minimal 1',
        ];
    }
}
