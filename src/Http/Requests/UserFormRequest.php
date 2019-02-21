<?php

namespace Davidcb\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
        if ($this->method() == 'PUT') {
            return [
                'email' => 'required|email',
                'name' => 'required',
                'role_id' => 'required|integer',
            ];
        } else {
            return [
                'email' => 'required|email',
                'name' => 'required',
                'password' => 'required|confirmed',
                'role_id' => 'required|integer',
            ];
        }
    }
}
