<?php

namespace App\Http\Requests;

use App\DTOs\RegisterDTO;
use App\Enums\UserRoles;
use App\Helpers\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'role' => ['required', Rule::in(UserRoles::values())], // Ensure 'role' is validated first
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'ends_with:@gmail.com', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'gender' => ['required', 'string', 'in:male,female'],
        ];
    }

    /**
     * Add conditional validation rules based on the role field.
     */
    public function withValidator($validator)
    {
        $clientFields = [
            'age' => ['required', 'integer', 'min:1'],
            'height' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
        ];

        $trainerFields = [
            'experience_years' => ['required', 'integer'],
            'service_id' => ['required', 'exists:services,id'],
            'cv' => ['required', 'file', 'mimes:pdf,doc,docx|max:2048'],
        ];

        $validator->sometimes(array_keys($clientFields), $clientFields, function ($input) {
            return $input->role === 'client';
        });

        $validator->sometimes(array_keys($trainerFields), $trainerFields, function ($input) {
            return $input->role === 'trainer';
        });
    }

    /**
     * Handle failed validation.
     */
    protected function failedValidation(Validator $validator)
    {
        ResponseHelper::sendError('Validation error', 422, $validator->errors())->throwResponse();
    }

    /**
     * Convert the validated request to a Data Transfer Object.
     */
    public function toDTO(): RegisterDTO
    {
        return new RegisterDTO(
            role: $this->input('role'),
            name: $this->input('name'),
            email: $this->input('email'),
            password: $this->input('password'),
            gender: $this->input('gender'),
            age: $this->input('age'),
            height: $this->input('height'),
            weight: $this->input('weight'),
            experience_years: $this->input('experience_years'),
            service_id: $this->input('service_id'),
            cv: $this->file('cv')
        );
    }
}
