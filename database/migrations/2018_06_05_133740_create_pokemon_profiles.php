<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePokemonProfiles extends Migration {
	/**
	 * Table name
	 *
	 * @var string
	 */
	protected $name = 'pokemon_profiles';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		if ( ! Schema::hasTable( $this->name ) ) {
			Schema::create( $this->name, function ( Blueprint $table ) {
				$table->increments( 'id' );
				$table->integer( 'pokemons_id' )->index();
				$table->string( 'sprite' );
				$table->integer( 'base_experience' );
				$table->integer( 'height' );
				$table->integer( 'weight' );
				$table->mediumText( 'info' );
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
