<?php

namespace App\DTOs;

class ReportDTO
{
    public function __construct(
        public string $subject,
        public string $body
    ) {}

    public function toArray(): array
    {
        return [
            'user_id' => auth()->id(),
            'subject' => $this->subject,
            'body' => $this->body
        ];
    }
}
