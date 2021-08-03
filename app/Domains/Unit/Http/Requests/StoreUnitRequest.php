<?php

namespace App\Domains\Unit\Http\Requests;

use App\Domains\Unit\Models\Unit;
use App\Domains\Qualification\Models\Qualification;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class StoreQualificationRequest.
 */
class StoreUnitRequest extends FormRequest
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
}
