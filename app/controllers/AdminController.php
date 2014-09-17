<?php

require_once(__DIR__ . './../../public/includes/php/classes/Utilities.php');

class AdminController extends BaseController
{

    public $restful = true;
    protected $layout = "layouts.main";
    private $pagination = 7;


    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only' => array('getIndex')));
        $this->beforeFilter('auth', array('only' => array('getCreate')));
        $this->beforeFilter('auth', array('only' => array('postStore')));
        $this->beforeFilter('auth', array('only' => array('getIndex')));
    }

    /**
     * Return index page for /admin if authorized, otherwise go to /auth/login.
     *
     * @return View
     */

    public function index()
    {
        if (Auth::check()) {
            $user = User::first();
            if (is_null($user)) {
                $users = User::all();
                return Redirect::route('admin.index', compact('users'));
            } else {
                $utility = new common\Utilities();
                $user['dob'] = $utility->convertMySQLFormatToDatePickerFormat($user['dob']);
                $paginatedUsers = User::paginate($this->pagination);
                return View::make('admin.show', compact('user', 'paginatedUsers'));
            }
        } else {
            return View::make('auth.login');
        }
    }

    /**
     * Go to the Create form to add a User.
     *
     * @return View
     */

    public function create()
    {
        if (Auth::check()) {
            return View::make('admin.create');
        } else {
            return View::make('auth.login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if (Auth::check()) {
            $input = Input::all();
            $validation = Validator::make($input, User::$createRules);

            if ($validation->passes()) {
//TODO: hash password before saving and figure out why auth breaks down
                //$input['password'] = Hash::make($input['password']);
                $utility = new common\Utilities();
                $input['dob'] = $utility->convertDatePickerFormatToMySQLFormat($input['dob']);
                User::create($input); //find the new id
                $users = User::all();
                return Redirect::route('admin.index', compact('users'));
            }

            return Redirect::route('admin.create')
                ->withInput()
                ->withErrors($validation)
                ->with('message', 'There were validation errors.');
        } else {
            return View::make('auth.login');
        }
    }

    /**
     * For showing individual records
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        if (Auth::check()) {
            $user = User::find($id);
            if (is_null($user)) {
                $users = User::all();
                return Redirect::route('admin.index', compact('users'));
            } else {
                $utility = new common\Utilities();
                $user['dob'] = $utility->convertMySQLFormatToDatePickerFormat($user['dob']);
                $paginatedUsers = User::paginate($this->pagination);
                return View::make('admin.show', compact('user', 'paginatedUsers'));
            }
        } else {
            return View::make('auth.login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        if (Auth::check()) {
            $user = User::find($id);
            if (is_null($user)) {
                $users = User::all();
                return Redirect::route('admin.index', compact('users', $id));
            }
            $utility = new common\Utilities();
            $user['dob'] = $utility->convertMySQLFormatToDatePickerFormat($user['dob']);
            return View::make('admin.edit', compact('user'));
        } else {
            return View::make('auth.login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        if (Auth::check()) {
            $input = Input::all();
            $validation = Validator::make($input, User::$updateRules);
            $user = User::find($id);

            if ($validation->passes()) {
                $utility = new common\Utilities();
                $input['dob'] = $utility->convertDatePickerFormatToMySQLFormat($input['dob']);
                $user->update($input);
                $users = User::all();
                return Redirect::route('admin.show', $id);
            }
            return Redirect::route('admin.edit', $id)
                ->withInput()
                ->withErrors($validation)
                ->with('message', 'There were validation errors.');
        } else {
            return View::make('auth.login');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (Auth::check()) {
            User::find($id)->delete();
            $users = User::all();
            return Redirect::route('admin.index', compact('users'));
        } else {
            return View::make('auth.login');
        }
    }

}