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
		Schema::create('userRoles', function($table)
	    {
	        $table->increments('id')->unique();
	        $table->string('role');
	    });

		Schema::create('users', function($table)
	    {
	        $table->string('email')->unique();
	        $table->string('password',60);
	        $table->integer('role_id',false,true);
	        $table->boolean('is_host')->default(false);
	        $table->boolean('is_admin')->default(false);
	        $table->timestamps();
			$table->rememberToken();

			$table->primary('email');
			$table->foreign('role_id')->references('id')->on('userRoles');
	    });

	    Schema::create('addresses', function($table)
	    {
	    	$table->increments('id')->unique();
	    	$table->string('address_line_1');
	        $table->string('address_line_2');
	        $table->string('address_line_3');
	        $table->string('postcode');
			$table->string('city');
			$table->string('state');
			$table->string('country');
	    });

	    Schema::create('usersProfile', function($table)
	    {
	        $table->string('username')->unique();
	        $table->string('title');
	        $table->string('name');
	        $table->string('surname');
	        $table->string('email')->unique();
	        $table->string('phone');
	        $table->integer('address_id',false,true);
	        $table->string('trn');
	       
	       	$table->primary('username');
	        $table->foreign('username')->references('email')->on('users');
	        $table->foreign('address_id')->references('id')->on('addresses');
	    });

	    Schema::create('rooms', function($table)
	    {
	    	$table->increments('id')->unique();
	    	$table->string('host_username');
	        $table->string('title');
	        $table->string('description');
	        $table->string('bed_no');
	       	$table->integer('address_id',false,true);
			$table->string('comments');
			$table->boolean('air_condition');
			$table->boolean('bathroom');
			$table->boolean('tv');
			$table->timestamps();

	       	$table->unique(array('id', 'host_username'));
	        $table->foreign('host_username')->references('email')->on('users');
	       	$table->foreign('address_id')->references('id')->on('addresses');
	    });
	    /* Manually add a composite primary key */
		/*DB::statement('ALTER TABLE rooms DROP PRIMARY KEY, ADD PRIMARY KEY(id,username);');*/

	    Schema::create('roomQuotes', function($table)
	    {
	        $table->increments('id')->unique;
	        $table->string('traveller_username');
	        $table->date('from');
	        $table->date('to');
	        $table->integer('visitors_no');
	        $table->boolean('active');
	        $table->date('expiry');
	        $table->boolean('notification_sent');
	        $table->string('notification_type');

	       	$table->unique(array('id', 'traveller_username'));
	        $table->foreign('traveller_username')->references('email')->on('users'); 
	    });
	    /* Manually add a composite primary key */
		/*DB::statement('ALTER TABLE roomQuotes DROP PRIMARY KEY, ADD PRIMARY KEY(id,username);');*/

	    Schema::create('roomOffers', function($table)
	    {
	        $table->increments('id')->unique;
	        $table->integer('quote_id',false,true);
	        $table->integer('room_id',false,true);
	        $table->float('price');
	        $table->boolean('active');
	        $table->date('expiry');
	        $table->boolean('notification_sent');
	        $table->string('notification_type');
	        $table->boolean('offer_accepted');

	       	$table->unique(array('quote_id','room_id'));
	        $table->foreign('quote_id')->references('id')->on('roomQuotes');
	        $table->foreign('room_id')->references('id')->on('rooms');
	    });
	    /* Manually add a composite primary key */
		/*DB::statement('ALTER TABLE roomOffers DROP PRIMARY KEY, ADD PRIMARY KEY(id,username,quote_id,room_id);');*/

	    Schema::create('financialTransactions', function($table)
	    {
	        $table->increments('id')->unique;
			$table->string('method');
			$table->date('date_created');
			$table->date('date_txn');
			$table->float('amount_net');
			$table->float('amount_total');
			$table->float('amount_vat');
			$table->float('amount_fees');
			$table->string('currency_iso');
			$table->enum('type',array('payment','refund'))->default('payment');
			$table->enum('status',array('pending','posted','rejected'));
	        $table->integer('offer_id',false,true)->unique;
	        $table->string('host_username')->unique;
	        $table->string('traveller_username')->unique;
	        
	       	$table->unique(array('offer_id','host_username','traveller_username'),'financialtransactions_offer_id_host_traveller_username_unique');
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
		Schema::drop('financialTransactions');
		Schema::drop('roomOffers');
		Schema::drop('roomQuotes');
		Schema::drop('usersProfile');
		Schema::drop('rooms');
		Schema::drop('addresses');
		Schema::drop('users');
		Schema::drop('userRoles');
	}

}
