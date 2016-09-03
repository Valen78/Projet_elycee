<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display login form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'Connexion';

        return view('auth.login', compact('title'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function login(Request $request)
    {
        if($request->isMethod('post')){
            $this->validate($request, [
                'username' => 'required|string',
                'password' => 'required',
                'remember' => 'in:remember'
            ]);

            $remember = !empty($request->input('remember'))?true:false;
            $credentials = $request->only('username','password');

            if(Auth::attempt($credentials, $remember)){
                return redirect('admin');
            }
            else
                return back()->withInput($request->only('username','remember'))
                    ->with('message','Erreur d\'authentification !');
        }
        else{
            return view('auth.login');
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
