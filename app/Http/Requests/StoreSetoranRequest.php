<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSetoranRequest extends FormRequest
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
            'user_id'              => 'required|exists:users,id',
            'catatan'               => 'nullable|string',
            'items'                 => 'required|array|min:1',
            'items.*.kategori_id'  => 'required|exists:kategori_sampah,id',
            'items.*.berat_kg'     => 'required|numeric|min:0.1',
        ];
    }
}
