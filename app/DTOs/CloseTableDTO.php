<?php

namespace App\DTOs;

class CloseTableDTO
{
    public function __construct(
        public int $tableId
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            tableId: $request->input('table_id')
        );
    }

}
