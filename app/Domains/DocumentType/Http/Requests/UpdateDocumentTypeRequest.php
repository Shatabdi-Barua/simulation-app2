<?php

namespace App\Domains\DocumentType\Http\Requests;

use App\Domains\DocumentType\Models\DocumentType;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateUserRequest.
 */
class UpdateDocumentTypeRequest extends FormRequest
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
            
            'type' => ['required', 'max:255'],     
            
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
    // }

    // /**
    //  * Handle a failed authorization attempt.
    //  *
    //  * @return void
    //  *
    //  * @throws \Illuminate\Auth\Access\AuthorizationException
    //  */
    // protected function failedAuthorization()
    // {
    //     throw new AuthorizationException(__('Only the administrator can update this user.'));
    // }
}
