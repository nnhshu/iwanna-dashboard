<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesRequest extends FormRequest
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
        $validationRules = [
            'title' => 'required',
            'description' => 'nullable'
        ];

        switch ($this->method()) {
            case 'POST':
                $validationRules['title'] = 'required|unique:categories';
                break;
            case 'PUT':
                break;
            default:
                break;
        }
        return $validationRules;
    }

    public function messages()
    {
        return [
            'title.required' => 'Tên danh mục không được bỏ trống',
            'title.unique' => 'Tên danh mục đã tồn tại',
        ];

    }

}
