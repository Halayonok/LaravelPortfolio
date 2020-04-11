<?php

namespace App\Http\Requests;

use App\Services\LocalisationService\LocalisationToggleService;
use Illuminate\Foundation\Http\FormRequest;

class TagUpdate extends FormRequest
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

        $rules = [
            'back_name' => 'required|string',
            'enable' => 'required|integer',
        ];

        $dataRules = [];
        foreach (LocalisationToggleService::getLanguages() as $language) {
            $dataRules['title_' . $language] = 'string|nullable';
        }

        return $rules;
    }
}
