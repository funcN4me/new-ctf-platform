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

        $categoryRule = 'required|integer|exists:categories,id';
        $subcategoryRule = 'required|integer|exists:subcategories,id';

        if (!is_numeric($this->category_id)) {
            $categoryRule = 'required|string|unique:categories,name';
        }

        if (!is_numeric($this->subcategory_id)) {
            $subcategoryRule = 'required|string|unique:subcategories,name';
        }

        return [
            'name' => 'required|string|max:255|unique:tasks,name,' . $taskId,
            'description' => 'required|string|max:255',
            'category_id' => $categoryRule,
            'subcategory_id' => $subcategoryRule,
            'files' => 'nullable|array',
            'files.*' => 'nullable|file|max:10240',
            'url' => 'nullable|url|max:255',
            'flag' => 'required|string|max:255|unique:tasks,flag,' . $taskId,
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Название',
            'description' => 'Описание',
            'category_id' => 'Категория',
            'subcategory_id' => 'Подкатегория',
            'files' => 'Файлы',
            'url' => 'Ссылка',
            'flag' => 'Флаг',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения',
            'name.unique' => 'Задача с таким названием уже существует',
            'flag.unique' => 'Задача с таким флагом уже существует',
            'files.*.max' => 'Максимальный размер файла 10 Мб',
            'max' => 'Поле :attribute не должно превышать :max символов',
            'category_id.exists' => 'Выбранная категория не существует',
            'subcategory_id.exists' => 'Выбранная подкатегория не существует',
            'url' => 'Поле :attribute должно быть валидным URL',
        ];
    }
}
