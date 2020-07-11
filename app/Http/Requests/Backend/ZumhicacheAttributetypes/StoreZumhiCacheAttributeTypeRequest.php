<?php

namespace App\Http\Requests\Backend\ZumhicacheAttributetypes;

use Illuminate\Foundation\Http\FormRequest;

class StoreZumhiCacheAttributeTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('store-zumhicacheattributetype');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'attribute_id'      => 'required',
            'name'              => 'required|max:191',
            'hasYesOption'      => 'nullable|boolean',
            'hasNoOption'       => 'nullable|boolean',
            'yesIconUrl'        => 'nullable|url',
            'noIconUrl'         => 'nullable|url',
            'notChosenIconUrl'  => 'nullable|url',
        ];
    }

    public function messages()
    {
        return [
            'attribute_id.required' => 'Atrribute is required.'
        ];
    }
}
