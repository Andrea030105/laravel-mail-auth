<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'          => ['required', 'max:150', Rule::unique('projects')->ignore($this->project)],
            'description'    => ['nullable', 'string'],
            'type_id'        => ['nullable', 'exists:types,id'],
            'technologies'   => ['nullable', 'array'],
            'technologies.*' => ['exists:technologies,id'],
            'image' => ['nullable']
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'        => 'Il titolo è obbligatorio!',
            'title.max'             => 'Il titolo non può superare 150 caratteri!',
            'title.unique'          => 'Questo titolo esiste già!',
            'type_id.exists'        => 'Devi selezionare un tipo valido!!',
            'technologies.*.exists' => 'Devi selezionare una tecnologia valida!!',
        ];
    }
}
