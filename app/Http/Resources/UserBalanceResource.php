<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserBalanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message'=>'Стол успешно закрыт.',
            'id' => $this->id,
            'user_id' => $this->id_user,
            'product_id' => $this->id_balance,
            'sum' => $this->sum,
        ];
    }
}
