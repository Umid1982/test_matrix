<?php

namespace App\Repositories;

use App\DTOs\CreateTableDTO;
use App\Models\MatrixProduct;
use App\Models\MatrixTable;
use App\Models\User;
use App\Models\UserBalance;

class MatrixTableRepository
{
    public function create(CreateTableDTO $DTO): MatrixTable
    {
        $product = MatrixProduct::findOrFail($DTO->productId);
        return MatrixTable::query()->create(
            [
                'id_user' => $DTO->userId,
                'id_product' => $DTO->productId,
                'sum' => $product->sum,
                'percent' => 50,
                'status' => 0,
            ]);
    }

    public function find(int $tableId): ?MatrixTable
    {
        return MatrixTable::query()->findOrFail($tableId);
    }

    public function update(MatrixTable $table, array $data, $authUser = null): bool
    {
        if ($authUser !== null) {
            User::query()
                ->whereIn('id', [$table->user1, $table->user2, $table->user3])
                ->update(['id_ref' => $authUser]);
        }
        return $table->update($data);
    }

    public function calculateProfit(MatrixTable $table): float
    {
        $isFirstTable = !$this->isFirstTable($table->id_user, $table->id);

        $multiplier = $isFirstTable ? 3 : 2; // Используем множитель в зависимости от типа стола

        return $table->product->sum * $multiplier * ($table->percent / 100);
    }

    public function distributeProfit(int $userId, float $profit): UserBalance
    {
        $balance = UserBalance::query()->where([
            'id_user' => $userId,
            'id_balance' => 1,
        ])->first();

        if ($balance) {
            // Если запись существует, суммируем значение
            $balance->sum += $profit;
            $balance->save();
        } else {
            // Если записи нет, создаем новую
            $balance = UserBalance::create([
                'id_user' => $userId,
                'id_balance' => 1,
                'sum' => $profit,
            ]);
        }

        // Возвращаем обновленную запись
        return $balance->refresh();
    }

    protected function isFirstTable(int $userId, int $currentTableId): bool
    {
        return !MatrixTable::query()
            ->where('id_user', $userId)
            ->where('id', '!=', $currentTableId)
            ->exists();
    }

}
