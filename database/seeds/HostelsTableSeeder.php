<?php

use Illuminate\Database\Seeder;

class HostelsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('hostels')->insert([
			'name' => 'Ducs De Bourgogne',
			'category' => 'BEST WESTERN',
			'city' => 'Paris',
			'zipCode' => '75001',
			'coordx' => '48.85344',
			'coordy' => '2.33793',
			'address' => '19 Rue Du Pont Neuf',
			'coord' => '93530',
		]);
		DB::table('hostels')->insert([
			'name' => 'Grand Hotel',
			'category' => 'BEST WESTERN',
			'city' => 'Le Touquet',
			'zipCode' => '62520',
			'coordx' => '50.526834',
			'coordy' => '1.596451',
			'address' => '4 boulevard de la Canche',
			'coord' => '93825',
		]);
		DB::table('hostels')->insert([
			'name' => 'Royal Saint Michel',
			'category' => 'BEST WESTERN PREMIER',
			'city' => 'Paris',
			'zipCode' => '75005',
			'coordx' => '48.8529',
			'coordy' => '2.3439',
			'address' => '3, Boulevard Saint Michel',
			'coord' => '93599',
		]);
		DB::table('hostels')->insert([
			'name' => 'Saint Louis',
			'category' => 'BEST WESTERN',
			'city' => 'Vincennes',
			'zipCode' => '94300',
			'coordx' => '48.844836',
			'coordy' => '2.435617',
			'address' => '2 Bis Rue Robert Giraudineau',
			'coord' => '93679',
		]);
		DB::table('hostels')->insert([
			'name' => 'Rives de Paris La Defense',
			'category' => 'BEST WESTERN',
			'city' => 'Courbevoie',
			'zipCode' => '92400',
			'coordx' => '48.897677',
			'coordy' => '2.262553',
			'address' => '85 Boulevard Saint-Denis',
			'coord' => '93838',
		]);
		DB::table('hostels')->insert([
			'name' => 'Paris Orly Airport',
			'category' => 'BEST WESTERN',
			'city' => 'Rungis',
			'zipCode' => '94656',
			'coordx' => '48.75287',
			'coordy' => '2.350882',
			'address' => '4 Avenue Charles Lindbergh',
			'coord' => '93780',
		]);
	}
}