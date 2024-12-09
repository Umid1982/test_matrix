<?php

namespace App\Repositories;

use App\DTOs\CreateTableDTO;
use App\Models\MatrixTable;

class MatrixTableRepository
{
    public function create(CreateTableDTO $DTO): MatrixTable
    {
        return MatrixTable::query()->create(
            [
                'id_user' => $DTO->userId,
                'id_product' => $DTO->productId,
                'sum' => 0,
                'percent' => 50,
                'status' => 0,
            ]);
    }

    public function find(int $tableId): ?MatrixTable
    {
        return MatrixTable::query()->findOrFail($tableId);
    }

    public function update(MatrixTable $table, array $data): bool
    {
        return $table->update($data);
    }

    public function calculateProfit(MatrixTable $table): float
    {
        $totalParticipants = 3; // Количество участников в столе
        return $table->product->sum * $totalParticipants * ($table->percent / 100);
    }

}
