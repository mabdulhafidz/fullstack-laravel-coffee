<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nip' => 'required|integer',
            'nik' => 'required|integer',
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|in:pria,wanita',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'telpon' => 'required|integer',
            'agama' => 'required|string',
            'status_nikah' => 'required|in:belum nikah,nikah',
            'alamat' => 'required|string',
            'golongan_id' => 'required|integer|exists:golongans,id',
            'image' => 'required|string',
        ];
    }
}
