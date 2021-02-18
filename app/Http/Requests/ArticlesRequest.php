<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticlesRequest extends FormRequest
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
            'content' => 'required'
        ];

        switch ($this->method()) {
            case 'POST':
                $validationRules['title'] = 'required|unique:articles';
                $validationRules['content'] = 'required';
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
            'title.required' => 'Tên bài viết không được bỏ trống',
            'title.unique' => 'Tên bài viết đã tồn tại',
            'content.required' => 'Nội dung không được bỏ trống',
        ];

    }
}
