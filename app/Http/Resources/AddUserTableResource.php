<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddUserTableResource extends JsonResource
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
            'id_user' => $this->id_user,
            'id_product' => $this->id_product,
            'sum' => number_format($this->sum, 2),
            'percent' => number_format($this->percent, 2),
            'user1' => $this->user1,
            'user2' => $this->user2,
            'user3' => $this->user3,
            'status' => $this->status,
        ];
    }
}
