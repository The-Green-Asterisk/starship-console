<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SessionsController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->toArray();

        $validator = Validator::make($data, [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:6'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 200);
        }else{
            if (auth()->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect('starship/' . auth()->user()->characters->where('is_active')->first()->starship->id);
            }else{
                return redirect('/login');
            }
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}
