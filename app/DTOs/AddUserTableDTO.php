<?php

namespace App\DTOs;

class AddUserTableDTO
{
    public function __construct(
        public int $tableId,
        public int $userId
    )
    {
    }

}
