<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Http\FormRequest;

class EmailVerificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        $user = \App\Models\User::find($this->route('id'));

        abort_if(!$user, 403);
        abort_if(! hash_equals((string) $this->route('hash'),
        sha1($user->getEmailForVerification())), 403);


        // if (! hash_equals((string) $this->route('id'),
        //                   (string) $this->user()->getKey())) {
        //     return false;
        // }

        // if (! hash_equals((string) $this->route('hash'),
        //                   sha1($this->user()->getEmailForVerification()))) {
        //     return false;
        // }

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
            //
        ];
    }

    /**
     * Fulfill the email verification request.
     *
     * @return void
     */
    public function fulfill()
    {

        dd("Working fine");
        
        if (! $this->user()->hasVerifiedEmail()) {
            $this->user()->markEmailAsVerified();

            event(new Verified($this->user()));
        }
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        return $validator;
    }
}
