<?php

namespace App\Http\Controllers\Api;

use App\DTOs\CloseTableDTO;
use App\DTOs\CreateTableDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Table\StoreRequest;
use App\Http\Requests\Table\User\StoreUserRequest;
use App\Http\Requests\Table\UserIdRequest;
use App\Http\Resources\AddUserTableResource;
use App\Http\Resources\TableResource;
use App\Models\MatrixTable;
use App\Services\MatrixTableService;
use Illuminate\Http\Request;

class MatrixTableController extends Controller
{
    public function __construct(protected readonly MatrixTableService $service)
    {
    }

    public function createTable(StoreRequest $request)
    {
        if ($this->service->hasActiveTable($request->toDTO()->userId)) {
            return response()->json(['error' => 'У вас уже есть активный стол.'], 400);
        }

        return response(TableResource::make($this->service->createTable($request->toDTO())));

    }

    public function addUser(StoreUserRequest $request)
    {
        try {

            return response(AddUserTableResource::make($this->service->addUserToTable($request->toDTO())));

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function closeTable(UserIdRequest $request)
    {
        try {
            $result = $this->service->closeTable($request->toDTO());

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
