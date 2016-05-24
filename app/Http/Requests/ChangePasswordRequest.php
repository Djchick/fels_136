<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class ChangePasswordRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        /**
         * @param  array $data
         *
         * @return \Illuminate\Contracts\Validation\Validator
         */
        $rule = config('common.user.rule');
        $user = Auth::user();
        return [
            'current_password'          => "password_hash_check:$user->password|string|min:{$rule['password_min']}",
            'new_password'              => "required|different:current_password|confirmed|min:{$rule['password_min']}",
            'new_password_confirmation' => "required|min:{$rule['password_min']}",
        ];
    }
}