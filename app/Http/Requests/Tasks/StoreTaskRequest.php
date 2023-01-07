<?php

namespace App\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
        $taskId = isset($this->task) ? $this->task->id : null;
        return [
            'name' => 'required|string|max:255|unique:tasks,name,' . $taskId,
            'description' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'subcategory_id' => 'required|integer|exists:subcategories,id',
            'files' => 'nullable|array',
            'files.*' => 'nullable|file|max:10240',
            'url' => 'nullable|url|max:255',
        ];
    }

    public $attributes = [
        'name' => 'Название',
        'description' => 'Описание',
        'category_id' => 'Категория',
        'subcategory_id' => 'Подкатегория',
        'files' => 'Файлы',
        'url' => 'Ссылка',
    ];

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения',
            'unique' => 'Задача с таким названием уже существует',
            'files.*.max' => 'Максимальный размер файла 10 Мб',
            'max' => 'Поле :attribute не должно превышать :max символов',
            'category_id.exists' => 'Выбранная категория не существует',
            'subcategory_id.exists' => 'Выбранная подкатегория не существует',
            'url' => 'Поле :attribute должно быть валидным URL',
        ];
    }
}
