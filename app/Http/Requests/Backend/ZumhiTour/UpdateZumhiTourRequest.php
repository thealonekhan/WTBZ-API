<?php

namespace App\Http\Requests\Backend\ZumhiTour;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateZumhiTourRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('update-zumhitour');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'referenceCode' => [
                'required',
                'max:36',
                Rule::unique('zumhitours')->ignore(request()->route('zumhitour')),
            ],
            'name'              => 'required|max:191',
            'coordinates_id'    => 'required',
            'sponsor_id'        => 'required',
            'description'       => 'nullable',
            'url'               => 'nullable|url',
            'coverImageUrl'     => 'nullable|url',
            'logoImageUrl'      => 'nullable|url',
        ];
    }

    public function messages()
    {
        return [
            'sponsor_id.required' => 'Sponsor field is required.',
            'coordinates_id.required' => 'Coordinates field is required.',
        ];
    }
}
