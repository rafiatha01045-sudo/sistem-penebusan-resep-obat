<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransaksiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'resep_id' => 'nullable|exists:reseps,id',
            'nama_pasien' => 'required|string|max:255',
            'total_harga' => 'required|numeric|min:0',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'status_pembayaran' => 'required|in:pending,lunas,batal',
            'tgl_transaksi' => 'required|date',
            'obats' => 'required|array|min:1',
            'obats.*.id' => 'required|exists:obats,id',
            'obats.*.qty' => 'required|numeric|min:1',
        ];
    }
}
