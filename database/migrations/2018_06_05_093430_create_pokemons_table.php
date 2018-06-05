<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePokemonsTable extends Migration {

	/**
	 * Table name
	 *
	 * @var string
	 */
	protected $name = 'pokemons';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		if ( ! Schema::hasTable( $this->name ) ) {
			Schema::create( $this->name, function ( Blueprint $table ) {
				$table->increments( 'id' );
				$table->string( 'name', 255 )->index();
				$table->string( 'url', 255 )->index();
				$table->timestamps();
			} );
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( $this->name );
	}
}
