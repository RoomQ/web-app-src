// app/database/seeds/UserTableSeeder.php

<?php

class UserTableSeeder extends Seeder
{

	public function run()
	{
		//DB::table('users')->delete();
		User::create(array(
			'name'     => 'Costas Pappas',
			'username' => 'costas',
			'email'    => 'cospappas@gmail.com',
			'password' => Hash::make('777777'),
		));
	}

}

