<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $applicantId = $this->route('applicant')->id ?? null;
        return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:applicants,email,' . $applicantId,
            'phone' => 'required|digits:10',
            'car' => 'nullable|in:Yes,No',
            'full_address' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:20',
            'apt_number' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:255',
        ];
    }
}
