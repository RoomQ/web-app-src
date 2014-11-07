<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomqTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
	    {
	        $table->string('email')->unique();
	        $table->string('password',60);
	        $table->enum('role',array('traveller','host','admin'))->default('traveller');
	        $table->boolean('is_host')->default(false);
	        $table->boolean('is_admin')->default(false);
	        $table->timestamps();
			$table->rememberToken();

			$table->primary('email');
	    });

	    Schema::create('usersProfile', function($table)
	    {
	        $table->string('username')->unique();
	        $table->string('title');
	        $table->string('name');
	        $table->string('surname');
	        $table->string('email')->unique();
	        $table->string('phone');
	        $table->string('address_line_1');
	        $table->string('address_line_2');
	        $table->string('address_line_3');
	        $table->string('postcode');
	        $table->string('trn');
	       
	       	$table->primary('username');
	        $table->foreign('username')->references('email')->on('users');
	    });

	    Schema::create('rooms', function($table)
	    {
	    	$table->increments('id')->unique();
	    	$table->string('username')->unique();
	        $table->string('title');
	        $table->string('description');
	        $table->string('bed_no');
	        $table->string('address_line_1');
	        $table->string('address_line_2');
	        $table->string('address_line_3');
	        $table->string('postcode');
			$table->string('comments');
			$table->timestamps();

	       	/*$table->primary(array('id', 'username'));*/	            
	        $table->foreign('username')->references('email')->on('users');
	    });
	    /* Manually add a composite primary key */
		DB::statement('ALTER TABLE rooms DROP PRIMARY KEY, ADD PRIMARY KEY(id,username);');

	    Schema::create('roomQuotes', function($table)
	    {
	        $table->increments('id')->unique;
	        $table->string('username')->unique;
	        $table->date('from');
	        $table->date('to');
	        $table->integer('visitors_no');
	        $table->boolean('notification_sent');
	        $table->string('notification_type');

	       	/*$table->primary(array('id', 'username'));*/
	        $table->foreign('username')->references('email')->on('users'); 
	    });
	    /* Manually add a composite primary key */
		DB::statement('ALTER TABLE roomQuotes DROP PRIMARY KEY, ADD PRIMARY KEY(id,username);');

	    Schema::create('roomOffers', function($table)
	    {
	        $table->increments('id')->unique;
	        $table->integer('quote_id',false,true)->unique;
	        $table->string('username')->unique;
	        $table->integer('room_id',false,true)->unique;
	        $table->float('price');
	        $table->boolean('notification_sent');
	        $table->string('notification_type');
	        $table->boolean('offer_accepted');

	       	/*$table->primary(array('id','quote_id','username','room_id'));*/
	        $table->foreign('quote_id')->references('id')->on('roomQuotes');
	        $table->foreign('username')->references('email')->on('users');
	        $table->foreign('room_id')->references('id')->on('rooms');
	    });
	    /* Manually add a composite primary key */
		DB::statement('ALTER TABLE roomOffers DROP PRIMARY KEY, ADD PRIMARY KEY(id,username,quote_id,room_id);');


	    Schema::create('payments', function($table)
	    {
	        $table->increments('id')->unique;
	        $table->date('payment_date');
	        $table->integer('offer_id',false,true)->unique;
	        $table->string('host_username')->unique;
	        $table->string('traveller_username')->unique;
	        $table->float('payment_amount');
	        $table->string('payment_method');
	        
	        /*$table->foreign('payment_amount')->references('price')->on('roomOffers');*/
	        $table->foreign('host_username')->references('email')->on('users');
	        $table->foreign('traveller_username')->references('email')->on('users');
	        $table->foreign('offer_id')->references('id')->on('roomOffers');
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payments');
		Schema::drop('roomOffers');
		Schema::drop('roomQuotes');
		Schema::drop('usersProfile');
		Schema::drop('rooms');
		Schema::drop('users');
	}

}
