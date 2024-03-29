<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        # Form validasyonu
        $validator = \Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'name.max' => 'İsim en fazla :max karakterden oluşabilir.',
                'email' => 'E-posta alanı zorunludur.',
                "password" => 'Parola alanı zorunludur.'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                "status" => "error",
                "message" => "Lütfen formdaki hataları giderin.",
                "errors" => $validator->errors()
            ]);
        }

        # E-mail kontrolü yapıyoruz
        $checkEmail = User::where('email', $request->email)->exists();

        if ($checkEmail) {
            return response()->json([
                "status" => "error",
                "message" => "Kayıt etmek istediğiniz e-posta adresi sistemimizde mevcut.",
            ]);
        }

        # Kullanıcı datası oluşturuyoruz ve create etmeyi deniyoruz.
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password)
        ];

        if (!User::create($userData)) {
            return response()->json([
                "status" => "error",
                "message" => "Kayıt edilirken bir hata oluştu.",
            ]);
        }

        return response()->json([
            "status" => "success",
            "message" => "Kayıt başarılı.",
        ]);
    }
}
