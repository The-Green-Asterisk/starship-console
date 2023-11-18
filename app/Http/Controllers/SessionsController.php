<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
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
        } else {
            if (auth()->attempt(['email' => $data['email'], 'password' => $data['password']], $data['remember_me'])) {
                session()->regenerate();

                return response()->json([
                    'redirect' => 'starship/'.auth()->user()->characters->where('is_active')->first()->starship->id,
                ]);
            } else {
                return response()->json(['error' => 'Invalid credentials'], 200);
            }
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function forgotPassword(Request $request)
    {
        $data = $request->toArray();

        $validator = Validator::make($data, [
            'email' => ['required', 'email', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 200);
        } else {
            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
        }
    }

    public function resetPasswordScreen($token)
    {
        $email = request()->query('email');

        return view('auth.passwords.reset', compact('token', 'email'));
    }

    public function resetPassword(Request $request)
    {
        $data = $request->toArray();

        $validator = Validator::make($data, [
            'password' => ['required', 'min:6'],
            'password_confirmation' => ['required', 'min:6'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 200);
        } else {
            User::where('email', $request->email)->setPasswordAttribute($request->password);
        }

        return redirect('/')->with('success', 'Password reset successfully');
    }
}
