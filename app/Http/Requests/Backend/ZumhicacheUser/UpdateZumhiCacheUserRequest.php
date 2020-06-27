<?php

namespace App\Http\Requests\Backend\ZumhicacheUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateZumhiCacheUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('update-zumhicacheuser');
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
                Rule::unique('zumhicacheusers')->ignore(request()->route('zumhicacheuser')),
            ],
            'user_id'               => 'required|integer',
            'membership_id'         => 'required|integer',
            'joinedDateUtc'         => 'nullable|date',
            'avatarUrl'             => 'nullable|url',
            'bannerUrl'             => 'nullable|url',
            'url'                   => 'nullable|url',
            'coordinates_id'        => 'required|integer',
            'isFriend'              => 'nullable|boolean',
            'optedInFriendSharing'  => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'User field is required.',
            'membership_id.required' => 'Membership field is required.',
            'coordinates_id.required' => 'Coordinates field is required.',
        ];
    }
}
