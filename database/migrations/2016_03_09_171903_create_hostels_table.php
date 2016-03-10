<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHostelsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('hostels', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('category');
			$table->string('city');
			$table->integer('zipCode');
			$table->double('coordx');
			$table->double('coordy');
			$table->string('address');
			$table->double('coord');
			$table->timestamps();
			$table->engine = 'InnoDB';
			$table->unique('address');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

		Schema::drop('hostels');
	}
}
