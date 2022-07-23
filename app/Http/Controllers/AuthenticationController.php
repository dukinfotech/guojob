<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{

    public function showRegisterForm() {
        return view('auth.register');
    }

    public function register(UserRegisterRequest $userRegisterReq) {
        try {
            $validatedData = $userRegisterReq->validated();

            $parent = User::where([
                'invite_code' => $validatedData['invite_code'],
                'role' => 'admin'
            ])->first();

            if (! $parent) {
                throw new \Exception('Mã mời không tồn tại');
            }

            $user = new User($validatedData);
            $user->password = password_hash($validatedData['password'], PASSWORD_DEFAULT);
            $user->passcode = password_hash($validatedData['passcode'], PASSWORD_DEFAULT);
            $user->invite_code = $this->generateInviteCode();
            $user->parent()->associate($parent);
            $user->save();

            return back()->with('success', true);
        } catch (\Exception $e) {
            return back()->withInput()->with('notFoundError', $e->getMessage());
        }
    }

    public function showLoginForm() {
        return view('auth.login');
    }

    private function generateInviteCode() {
        return Str::upper(Str::random(8));
    }

    public function login(UserLoginRequest $userLoginReq) {
        $validatedData = $userLoginReq->validated();
        $validatedData['phone'] = $validatedData['phoneOrUsername'];
        unset($validatedData['phoneOrUsername']);
        $validatedData2 = [
            'username' => $validatedData['phone'],
            'password' => $validatedData['password']
        ];

        if (Auth::attempt($validatedData) || Auth::attempt($validatedData2)) {
            request()->session()->regenerate();

            return redirect('/');
        }

        return back()->withInput()->with('notFoundError', 'Sai tên tài khoản hoặc mật khẩu');
    }
}
