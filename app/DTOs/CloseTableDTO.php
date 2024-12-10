<?php

namespace App\DTOs;

class CloseTableDTO
{
    public function __construct(
        public int $userId,
        public int $tableId
    ) {}
}
