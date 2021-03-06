<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Libraries\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function check(Request $request)
    {
        $this->validate($request, [
            'user.username' => 'required',
            'user.password' => 'required'
        ]);

        $username = $request->input('user.username');
        $password = $request->input('user.password');

        $userinfo = ['username' => $username, 'password' => $password];

        if ($this->auth->login($userinfo)->isAuthed()) {
            return redirect('/admin/index');
        } else {
            return redirect('/login')->with('error', '登录失败！');
        }
    }

    public function logout(Request $request)
    {
        $this->auth->logout();
        return redirect('/');
    }
}
