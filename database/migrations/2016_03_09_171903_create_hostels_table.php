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
			$table->string('address');
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
