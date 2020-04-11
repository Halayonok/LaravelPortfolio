<?php

namespace App\Http\Requests;

use App\Projects;
use App\Services\LocalisationService\LocalisationToggleService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectUpdate extends FormRequest
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
            'link' => 'nullable|string',
            'status' => ['required','string', Rule::in(Projects::getStatuses())],
            'enable' => 'required|integer',
        ];

        $dataRules = [];
        foreach (LocalisationToggleService::getLanguages() as $language) {
            $dataRules['title_' . $language] = 'string|nullable';
            $dataRules['content_' . $language] = 'string|nullable';
            $dataRules['meta_keywords_' . $language] = 'string|nullable';
            $dataRules['meta_description_' . $language] = 'string|nullable';
        }

        return $rules;
    }
}
