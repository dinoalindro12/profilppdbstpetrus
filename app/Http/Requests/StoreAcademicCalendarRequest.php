<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAcademicCalendarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Ganti dengan logika authorization yang sesuai
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240', // Max 10MB
            'academic_year' => 'required|string|max:9',
            'semester' => 'required|in:Ganjil,Genap,Antara',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'file.required' => 'File kalender akademik harus diupload',
            'file.mimes' => 'File harus berupa PDF, DOC, DOCX, JPG, JPEG, atau PNG',
            'file.max' => 'Ukuran file maksimal 10MB',
            'academic_year.max' => 'Format tahun akademik maksimal 9 karakter (contoh: 2023/2024)',
            'semester.in' => 'Semester harus berupa Ganjil, Genap, atau Antara',
            'end_date.after_or_equal' => 'Tanggal berakhir harus setelah atau sama dengan tanggal mulai',
        ];
    }
}