<?php

class AuthController extends BaseController{


    public function getLogin() {
        return View::make('auth.login');
    }

    public function postSignin() {
        $input = Input::all();
        $authenticated = Auth::check();

        if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')), true)) { //'password'=>Hash::make(Input::get('password'))
            return Redirect::to('admin/index')->with('message', 'You are now logged in!');
        } else {
            return Redirect::to('auth/login')
                ->with('message', 'Your username/password combination was incorrect')
                ->withInput();
        }
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::to('guest/index')->with('message', 'Your are now logged out!');
    }

}