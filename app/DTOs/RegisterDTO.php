<?php

namespace App\DTOs;

use App\Helpers\FileHelper;
use Illuminate\Http\UploadedFile;

class RegisterDTO
{
    public function __construct(
        public string $role,
        public string $name,
        public string $email,
        public string $password,
        public string $gender,
        public ?int $age = null,
        public ?int $experience_years = null,
        public ?int $service_id = null,
    ) {}

    /**
     * Convert the DTO into an array, filtering out null values.
     */
    public function toArray(): array
    {
        return array_filter([
            'role' => $this->role,
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'gender' => $this->gender,
            'age' => $this->age,
            'experience_years' => $this->experience_years,
            'service_id' => $this->service_id,
        ], fn($value) => !is_null($value));
    }
}
