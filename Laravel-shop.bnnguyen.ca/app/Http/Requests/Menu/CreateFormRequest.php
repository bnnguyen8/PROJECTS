<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
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
        return [
            'name' => 'required'
        ];
    }

    // https://laravel.com/docs/10.x/validation#customizing-the-error-messages
    public function messages() : array
    {
        return [
            'name.required' => 'Vui lòng nhập tên Danh Mục'
        ];
    }
}

// php artisan make:request Menu/CreateFormRequest