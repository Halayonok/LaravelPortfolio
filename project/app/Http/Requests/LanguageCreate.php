<?php

namespace App\Http\Requests;

use App\Projects;
use App\Services\LocalisationService\LocalisationToggleService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LanguageCreate extends FormRequest
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
            'code' => 'required|string|unique:languages',
            'main' => 'required|integer',
            'enable' => 'required|integer',
        ];
    }
}