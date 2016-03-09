<?php

use Illuminate\Database\Seeder;

class SentinelDatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		// Create Users
		DB::table('users')->truncate();

		$admin = Sentinel::getUserRepository()->create(array(
			'email' => 'admin@admin.com',
			'password' => 'password',
		));

		$user = Sentinel::getUserRepository()->create(array(
			'email' => 'benoit@gmail.com',
			'password' => 'password',
			'first_name' => 'Benoit',
			'last_name' => 'Miche',
			'reward' => '530',
			'ambassador' => '1',
			'address' => 'Paris,Marseille,Lille,Reims',
		));

		$user = Sentinel::getUserRepository()->create(array(
			'email' => 'francis@gmail.com',
			'password' => 'password',
			'first_name' => 'francis',
			'last_name' => 'louis',
			'reward' => '530',
			'ambassador' => '1',
			'address' => 'Paris,Rouen',
		));

		$user = Sentinel::getUserRepository()->create(array(
			'email' => 'anonymous@gmail.com',
			'password' => 'password',
			'pseudo' => 'anonymous',
			'ambassador' => '0',
		));

		// Create Activations
		DB::table('activations')->truncate();
		$code = Activation::create($admin)->code;
		Activation::complete($admin, $code);
		$code = Activation::create($user)->code;
		Activation::complete($user, $code);

		// Create Roles
		$administratorRole = Sentinel::getRoleRepository()->create(array(
			'name' => 'Administrator',
			'slug' => 'administrator',
			'permissions' => array(
				'users.create' => true,
				'users.update' => true,
				'users.view' => true,
				'users.destroy' => true,
				'roles.create' => true,
				'roles.update' => true,
				'roles.view' => true,
				'roles.delete' => true,
			),
		));
		$moderatorRole = Sentinel::getRoleRepository()->create(array(
			'name' => 'Moderator',
			'slug' => 'moderator',
			'permissions' => array(
				'users.update' => true,
				'users.view' => true,
			),
		));
		$subscriberRole = Sentinel::getRoleRepository()->create(array(
			'name' => 'Subscriber',
			'slug' => 'subscriber',
			'permissions' => array(),
		));

		// Assign Roles to Users
		$administratorRole->users()->attach($admin);
		$subscriberRole->users()->attach($user);
	}
}
