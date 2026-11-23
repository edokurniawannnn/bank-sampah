<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRewardRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mitra_id' => 'required|exists:mitra,id',
            'nama' => 'required|string|max:150',
            'poin_diperlukan' => 'required|integer|min:1',
            'stok' => 'required|integer|min:0',
            'aktif' => 'sometimes|boolean',
        ];
    }
}
