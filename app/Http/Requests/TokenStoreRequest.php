<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TokenStoreRequest extends FormRequest
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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        // Defines the validation rules that apply to the request. In this case, we specify that the 'user_id' field is required and must exist in the 'users' table.
        return [
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
