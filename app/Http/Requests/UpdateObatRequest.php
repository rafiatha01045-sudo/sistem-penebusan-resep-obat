<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateObatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kategori_id' => 'required|exists:kategori_obats,id',
            'nama_obat' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'tgl_expired' => 'required|date',
            'status' => 'required|in:tersedia,habis',
        ];
    }
}
