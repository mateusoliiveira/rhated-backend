<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class VehicleRequest extends FormRequest
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
            'brand_id' => 'required|string|exists:brands,id',
            'category_id' => 'required|string|exists:categories,id',
            'is_electric' => 'sometimes|boolean',
            'is_automatic' => 'sometimes|boolean',
            'name' => 'required|string|max:50|min:5',
            'year' => 'required|integer',
            'doors' => 'required|integer',
            'liters' => 'required|numeric',
            'cylinders' => 'required|integer',
            'horsepower' =>  'required|integer',
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
