<?php

namespace App\Http\Requests\Resources;

use Illuminate\Foundation\Http\FormRequest;

class StoreResourceRequest extends FormRequest
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
        $resourceId = isset($this->resource) ? $this->resource->id : null;
        return [
            'name' => 'required|string|unique:resources,name,' . $resourceId,
            'resource_parts' => 'required|array',
            'resource_parts.*' => 'required|string|max:255',
            'description' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Название',
            'resource_parts' => 'Основные части',
            'resource_parts.*' => 'Основная часть',
            'description' => 'Содержание',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения',
            'name.unique' => 'Такое название ресурса уже используется',
            'array' => 'Поле :attribute должно быть массивом',
            'max' => 'Поле :attribute должно превышать длину в :max символов',
        ];
    }
}
