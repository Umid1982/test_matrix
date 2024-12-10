<?php

namespace App\Services;

use App\DTOs\AddUserTableDTO;
use App\DTOs\CloseTableDTO;
use App\DTOs\CreateTableDTO;
use App\Models\Balance;
use App\Models\MatrixTable;
use App\Models\UserBalance;
use App\Repositories\MatrixTableRepository;
use Illuminate\Support\Facades\DB;

class MatrixTableService
{
    public function __construct(protected readonly MatrixTableRepository $repository)
    {
    }

    public function createTable(CreateTableDTO $dto)
    {
        return $this->repository->create($dto);
    }

    public function addUserToTable(AddUserTableDTO $dto)
    {
        $table = $this->repository->find($dto->tableId);

        if (!$table) {
            throw new \Exception('Стол не найден.');
        }

        // Список пользователей стола
        $users = ['user1', 'user2', 'user3'];

        foreach ($users as $key) {
            if (!$table->$key) {
                $table->$key = $dto->userId;

                // Закрываем стол, если добавлен третий пользователь
                if ($key === 'user3') {
                    $table->status = 1; // Закрываем стол
                }

                $this->repository->update($table, $table->toArray(),$dto->AuthUserId);
                return $table->refresh();
            }
        }

        throw new \Exception('Стол уже заполнен.');
    }

    public function hasActiveTable(int $userId): bool
    {
        return MatrixTable::query()->where('id_user', $userId)
            ->where('status', 0) // Открытый стол
            ->exists();
    }

    public function closeTable(CloseTableDTO $dto)
    {
        $table = $this->repository->find($dto->tableId);

        if ($table->status !== 1) {
            throw new \Exception('Стол еще не готов к закрытию.');
        }

        // Расчет прибыли
        $profitPerUser = $this->repository->calculateProfit($table);

        $balance = $this->repository->distributeProfit($dto->userId, $profitPerUser);

        // Обновление статуса стола
        $this->repository->update($table, ['status' => 2]); // 2 = Закрыт


        return  $balance;
    }
}
