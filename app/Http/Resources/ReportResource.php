<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'subject' => $this->subject,
            'body' => $this->body,
            'read_at' => is_null($this->read_at) ? null : $this->read_at->format('Y-m-d H:i:s'),
            'date' => $this->created_at->format('Y-m-d')
        ];
    }
}
