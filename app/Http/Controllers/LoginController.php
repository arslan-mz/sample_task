<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function Login(Request $credentials)
    {
        $emp_fetched = User::select('id', 'email', 'password')->where('email', $credentials->email)->get();
        if (isset($emp_fetched[0])) {
            if ($emp_fetched[0]->email == $credentials->email && $emp_fetched[0]->password == md5($credentials->pwd)) {
                $credentials->session()->put('emp_session', $emp_fetched[0]->id);
                return redirect('/dash');
            }
            else {
                Session::flash('message', 'Wrong Password!');
                Session::flash('alert-type', 'danger');
                return redirect('/home');
            }
        }
        else {
            Session::flash('message', 'No such user exists in our records!');
            Session::flash('alert-type', 'danger');
            return redirect('/home');
        }
    }

    public function Logout()
    {
        session()->pull('emp_session');
        return redirect('/home');
    }
}
