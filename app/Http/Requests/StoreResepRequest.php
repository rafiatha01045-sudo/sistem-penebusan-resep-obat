<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResepRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_pasien' => 'required|string|max:255',
            'nama_dokter' => 'required|string|max:255',
            'foto_resep' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'tgl_resep' => 'required|date',
            'status' => 'required|in:menunggu,diproses,selesai',
            'obats' => 'nullable|array',
            'obats.*.id' => 'required|exists:obats,id',
            'obats.*.qty' => 'required|numeric|min:1',
        ];
    }
}
