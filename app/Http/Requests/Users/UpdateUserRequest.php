<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()->isAdmin() || auth()->user()->id === $this->user->id) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|regex:/^[А-ЯЁ][а-яё]+$/u',
            'surname' => 'required|string|max:255|regex:/^[А-ЯЁ][а-яё]+$/u',
            'patronymic' => 'nullable|string|max:255|regex:/^[А-ЯЁ][а-яё]+$/u',
            'group' => 'nullable|string|max:10',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user->id,
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'group' => 'Группа',
            'email' => 'E-mail',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения',
            'unique' => 'Пользователь с таким :attribute уже существует',
            'max' => 'Поле :attribute не должно превышать :max символов',
            'regex' => 'Поле :attribute должно содержать только кириллические символы',
        ];
    }
}
