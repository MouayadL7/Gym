<?php

namespace App\Http\Requests;

use App\DTOs\SubscriptionDTO;
use App\Helpers\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class SubscribeRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('isClient');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'subscription_id' => ['required', 'exists:subscriptions,id']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return ResponseHelper::sendError('Validation error', 422, $validator->errors())->throwResponse();
    }

    public function toDTO(): SubscriptionDTO
    {
        return new SubscriptionDTO(
            subscriptionId: $this->input('subscription_id'),
        );
    }
}
