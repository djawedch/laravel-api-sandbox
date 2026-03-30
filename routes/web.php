<?php

use App\Models\User;
use Illuminate\Support\Facades\{Auth, Route, Hash};

Route::get('/', function () {
    return view('welcome');
});

Route::get('/setup', function() {
    $credentials = [
        'email' => 'admin@admin.com',
        'password' => 'password'
    ];

    if (!Auth::attempt($credentials)) {
        $user = new User();

        $user->name = 'Admin';
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);

        $user->save();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $adminToken = $user->createToken('admin-token', ['create', 'update', 'delete']);
            $updateToken = $user->createToken('admin-token', ['create', 'update']);
            $basicToken = $user->createToken('admin-token');

            return [
                'admin' => $adminToken->plainTextToken,
                'update' => $adminToken->plainTextToken,
                'basic' => $adminToken->plainTextToken,
            ];
        }
    }
});