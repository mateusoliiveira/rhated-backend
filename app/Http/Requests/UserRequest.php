<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UserRequest extends FormRequest
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

    public function userHashed() {
        $user = $this->validated();
        $user['password'] = Hash::make($user['password']);
        return $user;
    }

    public function rules()
    {
      return $this->method() === 'POST' || $this->method() === 'PATCH' ? [
        'email' => 'required|string|email|min:10|max:50|unique:users,email',
        'full_name' => 'required|string|min:5|max:50',
        'password' => 'required|string|min:6|max:20',
        'nickname' => 'required|string|min:3|max:12|unique:profiles,nickname',
      ] : [];
    }
}
