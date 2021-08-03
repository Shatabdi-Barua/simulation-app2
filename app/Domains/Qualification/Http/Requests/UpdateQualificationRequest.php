<?php

namespace App\Domains\Qualification\Http\Requests;

use App\Domains\Qualification\Models\Qualification;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateUserRequest.
 */
class UpdateQualificationRequest extends FormRequest
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
            'qualification_code' => ['required','unique:qualifications'],
            'title' => ['required', 'max:255'],     
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
