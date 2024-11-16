<?php

namespace App\Http\Requests;

use App\DTOs\UpdateSubscriptionDTO;
use App\Helpers\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateSubscriptionRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'price' => ['sometimes', 'numeric', 'min:0']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return ResponseHelper::sendError('Validation error', 422, $validator->errors())->throwResponse();
    }

    public function toDTO(): UpdateSubscriptionDTO
    {
        return new UpdateSubscriptionDTO(
            price: $this->input('price')
        );
    }
}
