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

		$ambassador = Sentinel::getUserRepository()->create(array(
			'email' => 'benoit@gmail.com',
			'password' => 'password',
			'first_name' => 'Benoit',
			'last_name' => 'Miche',
			'reward' => '530',
			'ambassador' => '1',
			'address' => 'Paris,Marseille,Lille,Reims',
		));

		$ambassador2 = Sentinel::getUserRepository()->create(array(
			'email' => 'francis@gmail.com',
			'password' => 'password',
			'first_name' => 'francis',
			'last_name' => 'louis',
			'reward' => '530',
			'ambassador' => '1',
			'address' => 'Paris,Rouen',
		));

		$prospect = Sentinel::getUserRepository()->create(array(
			'email' => 'anonymous@gmail.com',
			'password' => 'password',
			'first_name' => 'anonymous',
			'ambassador' => '0',
		));

		// Create Activations
		DB::table('activations')->truncate();
		$code = Activation::create($admin)->code;
		Activation::complete($admin, $code);
		$code = Activation::create($prospect)->code;
		Activation::complete($prospect, $code);
		$code = Activation::create($ambassador)->code;
		Activation::complete($ambassador, $code);
		$code = Activation::create($ambassador2)->code;
		Activation::complete($ambassador2, $code);

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
		$subscriberRole->users()->attach($prospect);
		$subscriberRole->users()->attach($ambassador);
		$subscriberRole->users()->attach($ambassador2);
	}
}
