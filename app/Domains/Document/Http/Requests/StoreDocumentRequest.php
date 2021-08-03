<?php

namespace App\Domains\Document\Http\Requests;

use App\Domains\Document\Models\Document;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class StoreQualificationRequest.
 */
class StoreDocumentRequest extends FormRequest
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
            'document_number' => ['required', 'unique:documents'],
            'title' => ['required'],
            'type' => ['required', 'max:255'],
            'description' => ['required'],
            'file'=> ['required'],                 
        ];
    }

    /**
     * @return array
     */
    // public function messages()
    // {
    //     return [
    //         'qualifications.title.exists' => __('This qualification name is already taken')
    //     ];
    //     // return [
    //     //     'roles.*.exists' => __('One or more roles were not found or are not allowed to be associated with this user type.'),
    //     //     'permissions.*.exists' => __('One or more permissions were not found or are not allowed to be associated with this user type.'),
    //     // ];
    // }
}
