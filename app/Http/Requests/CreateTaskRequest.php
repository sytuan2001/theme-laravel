<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $title;
 * @property string $description;
 */
class CreateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            'start_at' => 'required',
            'end_at' => 'required'
        ];
    }

    public function messages():array
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'description.required' => 'Vui lòng nhập nội dung.',
        ];
    }
}
