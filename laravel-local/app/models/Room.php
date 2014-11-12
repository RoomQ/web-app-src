<?php

class Room extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'rooms';

	public $timestamps = true;

	protected $fillable = ['username','title','description','address_line_1','address_line_2','address_line_3','postcode','comments'];

	public $errors;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	public function isValid(){
		$rules=static::$rules_register;
		if($caller_class == 'SessionsController'){
			$rules=static::$rules_login;
		}
		
		$validation = Validator::make($this->attributes	,$rules);

		if ($validation->passes()){
			return true;
		}

		$this->errors = $validation->messages();

		return false;
	}

}
