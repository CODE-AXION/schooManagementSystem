<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRole extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        switch ($this->method()) {
            case 'POST':
                // return $this->user()->can('roles.create');

                break;

            case 'PUT':
                // return $this->user()->can('roles.edit');

                break;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => 'required|string'
        ];
    }
}
