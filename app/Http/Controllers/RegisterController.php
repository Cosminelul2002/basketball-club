<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Codestage\Authorization\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function show()
    {
        return Inertia::render('Auth/Register');
    }

    public function register(Request $request, RegisterRequest $registerRequest)
    {
        // save user
        $data = $registerRequest->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        $user->user_roles()->insert([
            'user_id' => $user->id,
            'role_id' => Role::query()->where('key', 'user')->first()->id,
            'user_type' => 'App\Models\User',
        ]);

        $request->session()->flash('message', 'Inregistrare cu succes. Autentificati-va pentru a continua.');

        return redirect()->route('login');
    }
}
