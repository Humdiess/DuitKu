<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBudgetRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:1000',
            'period' => 'required|in:weekly,monthly,yearly',
            'start_date' => 'required|date',
            'alert_threshold' => 'required|integer|min:50|max:100',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori tidak valid.',
            'amount.required' => 'Jumlah budget wajib diisi.',
            'amount.min' => 'Jumlah budget minimal Rp 1.000.',
            'period.required' => 'Periode wajib dipilih.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'alert_threshold.required' => 'Batas peringatan wajib diisi.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->id(),
        ]);
    }
}
