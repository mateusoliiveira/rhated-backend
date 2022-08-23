<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;

class AuthRequest extends FormRequest
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

    public function rules()
    {
        return [

        ];
    }

    public function authentication()
    {
      try {
        $token = Auth::attempt([
          'email' => $this['email'],
          'password' => $this['password']
        ]);
        $user = $this->authedUser();
        return response()->json([
              'user' => $user,
              'token' => $token
        ]);
      } catch (JWTException $th) {
        throw new JWTException('Usuário ou senha incorreta', 401, $th);
      }
    }

    public function authedUser()
    {
        $user = Auth::user();
        if(!$user) {
            return response()->json([
                'errors' => 'Unauthorized'
            ], 401);
        }
        return $user;
    }

    public function authedLogout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'Logged Out',
        ], 200);
    }

    public function authedRefreshToken()
    {
        $refreshed = Auth::refresh();
        return $refreshed;
    }
}
