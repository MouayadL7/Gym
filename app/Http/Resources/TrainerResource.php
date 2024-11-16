<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainerResource extends JsonResource
{
    protected bool $includeCv = false;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'gender' => $this->user->gender,
            'role' => $this->user->role,
            'experience_years' => $this->experience_years,
            'service' => $this->service->name,
            // Only include CV if `includeCv` flag is true
            'cv' => $this->when($this->includeCv, $this->cv),
        ];
    }

    // Method to enable CV inclusion
    public function withCv(): self
    {
        $this->includeCv = true;
        return $this;
    }
}
