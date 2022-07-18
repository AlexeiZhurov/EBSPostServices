<?php

namespace App\Http\ApiV1\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class CreatePostsRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'     => ['required', 'max:255'],
            'preview'   => ['required', 'url'],
            'text'      => ['required'],
            'tags'      => ['nullable'],
            'user_id'   => ['required', 'integer'],
        ];
    }
}
