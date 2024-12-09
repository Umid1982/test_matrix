<?php

namespace App\Http\Requests\Table\User;

use App\DTOs\AddUserTableDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'table_id' => ['required', 'integer', Rule::exists('matrix_tables', 'id')],
            'user_id' => ['required', 'integer', Rule::exists('users', 'id')],
        ];
    }

    public function toDTO(): AddUserTableDTO
    {
        return new AddUserTableDTO(
            $this->get('table_id'),
            $this->get('user_id'),
        );
    }
}
