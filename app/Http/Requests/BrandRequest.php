<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BrandRequest extends FormRequest
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
        if($this->method() != 'POST' || $this->method() != 'PATCH') return [];

        return [
            'name' => 'required|string|max:50|min:3',
            'picture' => 'required|string'
        ];
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
