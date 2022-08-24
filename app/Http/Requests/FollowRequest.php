<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FollowRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
      return $this->method() === 'POST' || $this->method() === 'PATCH' ? [
        'user_followed_id' => 'required|string|exists:users,id',
      ] : [];
    }

    public function authedUser()
    {
        $user = Auth::user();
        if(!$user) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        return $user;
    }
}
