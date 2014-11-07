<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	public $timestamps = true;

	protected $hidden = array('password_confirmation','remember_token');

	protected $fillable = ['email','password','password_confirmation','role','is_host','is_admin','remember_token'];

	public static $rules = [
		'email' => 'required|email|unique:users',
		'password' => 'required|alphaNum|min:3',
		'password_confirmation' => 'sometimes|required|alphaNum|min:3|same:password'
	];

	public $errors;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function isValid(){
		$validation = Validator::make($this->attributes	,static::$rules);

		if ($validation->passes()){
			return true;
		}

		$this->errors = $validation->messages();

		return false;
	}

	public function getPassword()
	{
	    return $this->password;
	}

	public function setPassword($value)
	{
	    $this->password = Hash::make($value);
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
