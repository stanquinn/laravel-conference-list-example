<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{

    protected $guarded = array('id');
    protected $fillable = array('username', 'password', 'name','company_name', 'title', 'email',  'phone', 'address', 'city', 'state', 'zip', 'dob');

    public static $createRules = array(
        'name' => 'required|min:5',
        'username' => 'required|min:5|unique:users',
        'password' => 'required|min:8|confirmed',
        'email' => 'required|email|unique:users',
        /*'dob' => 'required|date_format:n/d/Y',*/
        'state' => 'max:2'
    );

    public static $updateRules = array(
        'name' => 'required|min:5',
        'username' => 'required|min:5',
        'email' => 'required|email',
        /*'dob' => 'required|date_format:n/d/Y',*/
        'state' => 'max:2'
    );


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */


    protected $hidden = array('password', 'remember_token');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        //TODO: hash passwords..updating when needed
        return Hash::make($this->password);
       // return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

}