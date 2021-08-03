<?php

namespace App\Domains\Qualification\Http\Requests;

use App\Domains\Qualification\Models\Qualification;
use App\Domains\Unit\Models\Unit;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class StoreQualificationRequest.
 */
class StoreQualificationRequest extends FormRequest
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
            'qualification_code' => ['required','unique:qualifications'],
            'title' => ['required', 'max:255', 'unique:qualifications'],     
            'release_date' => ['required'],
            'status'=> ['required'],
            'version'=> ['required'],    
            'units' => 'exists:App\Domains\Unit\Models\Unit,id'   
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'qualifications.title.exists' => __('This qualification name is already taken'),
            'qualifications.qualification_code.exists' => __('This qualification code is already taken')
        ];
        // return [
        //     'roles.*.exists' => __('One or more roles were not found or are not allowed to be associated with this user type.'),
        //     'permissions.*.exists' => __('One or more permissions were not found or are not allowed to be associated with this user type.'),
        // ];
    }
}
