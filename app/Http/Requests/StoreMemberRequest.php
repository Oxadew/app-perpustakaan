<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:200',
            'nim' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'nomor_telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'status' => 'required|string|max:100',
            
            //
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama  wajib diisi.',
            'nama.max' => 'Nama  maksimal 200 karakter.',
            'nim.required' => 'NIM wajib diisi.',
            'nim.string' => 'NIM harus berupa angka.',
            'nim.max' => 'NIM maksimal 20 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email tidak valid.',
            'email.max' => 'Email maksimal 100 karakter.',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi.',
            'nomor_telepon.string' => 'Nomor telepon harus berupa angka.',
            'nomor_telepon.max' => 'Nomor telepon maksimal 15 karakter.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',
            'status.required' => 'Status wajib diisi.',
            'status.max' => 'Status maksimal 100 karakter.',
        ];
    }
}
