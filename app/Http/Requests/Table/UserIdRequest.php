<?php

namespace App\Http\Requests\Table;

use App\DTOs\CloseTableDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserIdRequest extends FormRequest
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
        ];
    }

    public function toDTO(): CloseTableDTO
    {
        return new CloseTableDTO(
            $this->user()->id,
            $this->get('table_id'));
    }

}
