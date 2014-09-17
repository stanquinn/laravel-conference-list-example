<?php

require_once(dirname(dirname(__FILE__)) . '/public/includes/php/classes/Utilities.php');

Route::resource('admin', 'AdminController');

Route::controller('auth', 'AuthController');

Route::any('/', function () { //TODO: reduce the redundant code
    $users = User::all();
    foreach ($users as $user) {
        $utility = new common\Utilities();
        $user->dob = $utility->convertMySQLFormatToDatePickerFormat($user->dob);
    }
    if (Auth::check()) {
        return View::make('admin.index', compact('users'));
    } else {
        $pagination = 7;
        return View::make('guest.index', compact('users'));
    }
});

Route::any('guest/index', function () {
    if (Auth::check()) {
        $users = User::all();
        return View::make('admin.index', compact('users'));
    } else {
        $user = User::first();
        if (is_null($user)) {
            return View::make('guest.index');
        } else {
            $users = User::all();
            foreach ($users as $user) {
                $utility = new common\Utilities();
                $user->dob = $utility->convertMySQLFormatToDatePickerFormat($user->dob);
            }
            $pagination = 7;
            $paginatedUsers = User::paginate($pagination);
            return View::make('guest.show', compact('paginatedUsers', 'user'));
        }
    }
});

Route::any('guest/show/{id}', array('as'   => 'guest.show', function ($id) {
    $pagination = 7;
    $user = User::find($id);
    if (is_null($user)) {
        $users = User::all();
        return Redirect::route('guest.index', compact('users'));
    } else {
        $utility = new common\Utilities();
        $user['dob'] = $utility->convertMySQLFormatToDatePickerFormat($user['dob']);
        $paginatedUsers = User::paginate($pagination);
        return View::make('guest.show', compact('user', 'paginatedUsers'));
    }
}));

