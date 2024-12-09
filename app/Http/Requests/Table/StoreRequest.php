<?php

namespace App\Http\Requests\Table;

use App\DTOs\CreateTableDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'product_id' => ['required', 'integer', Rule::exists('matrix_products', 'id')]
        ];
    }

    public function toDTO(): CreateTableDTO
    {
        return new CreateTableDTO(
            $this->user()->id,
            $this->input('product_id')
        );
    }
}
