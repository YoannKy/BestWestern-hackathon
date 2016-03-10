<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Eloquent::unguard();
		DB::Statement('SET FOREIGN_KEY_CHECKS=0;');
		$this->call('HostelsTableSeeder');
		$this->call('SentinelDatabaseSeeder');
		DB::Statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
