<?php

namespace App\Http\Requests\Backend\Zumhicache;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateZumhiCacheRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('update-zumhicache');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'referenceCode'     => 'required|max:36|unique:zumhi_caches,referenceCode,:id',
            'referenceCode' => [
                'required',
                'max:36',
                Rule::unique('zumhi_caches')->ignore(request()->route('zumhicach')),
            ],
            'name'              => 'required|max:191',
            'difficulty'        => 'required|numeric',
            'terrain'           => 'required|numeric',
            'placedDate'        => 'nullable|date',
            'publishedDate'     => 'nullable|date',
            'eventEndDate'      => 'nullable|date',
            'user_id'           => 'required|integer',
            'type_id'           => 'required|integer',
            'size_id'           => 'required|integer',
            'country_id'        => 'required|integer',
            'state_id'          => 'required|integer',
            'ianaTimezoneId'    => 'required',
            'coordinates_id'    => 'required|integer',
            'lastVisitedDate'   => 'nullable|date',
            'shortDescription'  => 'required',
            'relatedWebPage'    => 'nullable|url',
            'url'               => 'nullable|url',
            'containsHtml'      => 'nullable|boolean',
            'hasSolutionChecker'=> 'nullable|boolean',
            'status_id'         => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'User field is required.',
            'type_id.required' => 'Type field is required.',
            'size_id.required' => 'Size field is required.',
            'country_id.required' => 'Country field is required.',
            'state_id.required' => 'State field is required.',
            'ianaTimezoneId.required' => 'Timezone field is required.',
            'coordinates_id.required' => 'Coordinates field is required.',
            'status_id.required' => 'Status field is required.',
        ];
    }
}
