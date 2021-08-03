<?php

namespace App\Domains\Unit\Http\Requests;

use App\Domains\Unit\Models\Unit;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateUserRequest.
 */
class UpdateUnitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return ! ($this->user->isMasterAdmin() && ! $this->user()->isMasterAdmin());
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
            'unit_code' => ['required', 'unique:units'],
            'title' => ['required', 'max:255'],
            'release_date' => ['required'],
            'status'=> ['required'],
            'version'=> ['required'],
            'qualifications' => 'exists:App\Domains\Qualification\Models\Qualification,id' 
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'units.unit_code.exists' => __('This unit code is already taken')
        ];
        // return [
        //     'roles.*.exists' => __('One or more roles were not found or are not allowed to be associated with this user type.'),
        //     'permissions.*.exists' => __('One or more permissions were not found or are not allowed to be associated with this user type.'),
        // ];
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function failedAuthorization()
    {
        throw new AuthorizationException(__('Only the administrator can update this user.'));
    }
}
