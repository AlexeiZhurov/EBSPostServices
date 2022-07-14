<?php

namespace App\Http\ApiV1\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;
use App\Http\ApiV1\Requests\SearchPostParams;

class SearchPostsRequest extends BaseFormRequest implements SearchPostParams
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'filter' => ['array'],
            'filter.reating_gte' => ['integer', 'min:0'],

            'include'   =>   ['array'],
            'include.*' =>   ['string'],

            'sort' => ['array'],
            'sort.*' => ['string'],
        ];
    }

    public function getFilter(): array
    {
        return $this->get('filter', []);
    }

    public function getSort(): array
    {
        return $this->get('sort', []);
    }

    public function isInclude(string $include): bool
    {
        return in_array($include, $this->get('include', ['default']));
    }
}
