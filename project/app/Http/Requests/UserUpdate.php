<?php

namespace App\Http\Requests;

use App\Services\LocalisationService\LocalisationToggleService;
use App\Users;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('get')) {
            return [];
        }

        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $this->route('id'),
            'password' => 'required|string',
            'role' => ['required','string', Rule::in(Users::getRoles())],
        ];
    }
}
