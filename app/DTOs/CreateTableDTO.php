<?php

namespace App\DTOs;

class CreateTableDTO
{
    public function __construct(
        public int $userId,
        public int $productId
    )
    {
    }

}
