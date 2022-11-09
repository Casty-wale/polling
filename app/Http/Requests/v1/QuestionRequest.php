<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'organisationName' => 'required',
            'description' => 'string',
            'critirial' => 'string',
            'category' => 'string',
            'priority' => 'numeric',
            'startDate' => 'required|date',
            'endDate' => 'date',
            'file' => 'file|mimes:xml'
        ];
    }
}
