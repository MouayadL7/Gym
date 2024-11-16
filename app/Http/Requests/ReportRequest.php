<?php

namespace App\Http\Requests;

use App\DTOs\ReportDTO;
use App\Helpers\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
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
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:1000']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return ResponseHelper::sendError('Validation error', 422, $validator->errors())->throwResponse();
    }

    public function toDTO(): ReportDTO
    {
        return new ReportDTO(
            subject: $this->input('subject'),
            body: $this->input('body')
        );
    }
}
