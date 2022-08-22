<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OfferRequest extends FormRequest
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
            'brand_id' => 'required|string|exists:brands,id',
            'category_id' => 'required|string|exists:categories,id',
            'vehicle_id' => 'required|string|exists:vehicles,id',
            'title' => 'required|string|max:50|min:10',
            'description' => 'required|string|max:150|min:10',
            'price' => 'required|numeric',
            'contact' => 'required|numeric|digits:11',
            'zip_code' => 'required|numeric|digits:8',
            'picture' => 'required|string'
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
