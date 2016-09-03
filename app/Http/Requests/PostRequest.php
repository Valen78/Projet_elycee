<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostRequest extends Request
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
            'user_id' => 'integer',
            'title' => 'required|string',
            'abstract' => 'string',
            'content' => 'required|string',
            'status' => 'required|in:publish,unpublish',
            'picture' => 'image|max:1024',
            'deleteImg' => 'in:deleteImg'
        ];
    }
}
