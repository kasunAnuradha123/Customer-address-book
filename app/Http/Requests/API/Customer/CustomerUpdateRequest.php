<?php

namespace App\Http\Requests\API\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric', 'digits:10'],
            'email' => ['required', 'string', 'email', "unique:customers,email" . (int) $this->route('id'), 'regex:/^(?:[a-zA-Z0-9._%+-]+)@(?:[a-zA-Z0-9-]+\.)+([a-zA-Z]{2,})$/',],
            'country' => ['required', 'string'],
        ];
    }
}
