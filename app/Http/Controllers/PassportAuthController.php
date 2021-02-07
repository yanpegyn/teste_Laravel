<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PassportAuthController extends Controller
{
    /**
     * Registration
     */
    public function register(Request $request)
    {
        $validator = validator()->make(request()->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'name.required' => "Esperado o campo 'name'",
            'name.min' => "O 'name' deve ter ao menos 3 caracteres",
            'email.required' => "Esperado o campo 'email'",
            'nome.email' => "O campo 'email' deve ser um Email",
            'password.required' => "Esperado o campo 'password'",
            'password.min' => "O campo 'password' deve ter ao menos 8 caracteres",
        ]);

        if ($validator->fails()) {
            abort(response()->json($validator->errors()->first(), 400));
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $validator = validator()->make(request()->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => "Esperado o campo 'email'",
            'nome.email' => "O campo 'email' deve ser um Email",
            'password.required' => "Esperado o campo 'password'",
            'password.min' => "O campo 'password' deve ter ao menos 8 caracteres",
        ]);

        if ($validator->fails()) {
            abort(response()->json($validator->errors()->first(), 400));
        }

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
