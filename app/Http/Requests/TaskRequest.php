<?php

namespace App\Http\Requests;

use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;


class TaskRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => ['sometimes', new Enum(TaskStatus::class)],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated();

        if (!array_key_exists('status', $data)) {
            // No se incluye status, así que no lo ponemos en $data
            return $data;
        }

        // Si sí existe, convertimos el enum a string
        $data['status'] = TaskStatus::from($data['status'])->value;

        return $data;
    }

}
