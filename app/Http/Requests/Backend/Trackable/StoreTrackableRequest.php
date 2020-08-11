<?php

namespace App\Http\Requests\Backend\Trackable;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrackableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('store-trackable');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'referenceCode'         => 'required|max:36|unique:trackables',
            'name'                  => 'required|max:191',
            // 'goal'                  => 'nullable',
            'ownerCode'             => 'required',
            // 'holderCode'            => 'nullable',
            'zumhiCode'             => 'required',
            'country_id'            => 'required|integer',
            'type_id'               => 'required|integer',
            'releasedDate'          => 'nullable|date',
            // 'description'           => 'nullable',
            'trackingNumber'        => 'nullable|integer',
            'kilometersTraveled'    => 'nullable|numeric',
            'milesTraveled'         => 'nullable|numeric',
            'iconUrl'               => 'nullable|url',
            'url'                   => 'nullable|url',
            'inHolderCollection'    => 'nullable|boolean',
            'isMissing'             => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'type_id.required' => 'Type field is required.',
            'country_id.required' => 'Country field is required.',
        ];
    }
}
