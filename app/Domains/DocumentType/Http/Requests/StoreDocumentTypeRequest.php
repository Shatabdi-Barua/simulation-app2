<?php

namespace App\Domains\DocumentType\Http\Requests;

use App\Domains\DocumentType\Models\DocumentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class StoreQualificationRequest.
 */
class StoreDocumentTypeRequest extends FormRequest
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
            'type' => ['required', 'max:255'],                
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
         
        ];
        // return [
        //     'roles.*.exists' => __('One or more roles were not found or are not allowed to be associated with this user type.'),
        //     'permissions.*.exists' => __('One or more permissions were not found or are not allowed to be associated with this user type.'),
        // ];
    }
}
