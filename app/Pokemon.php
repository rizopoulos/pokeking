<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model {

	public $table = 'pokemons';

	public function profile() {
		return $this->hasOne( 'App\PokemonProfile' );
	}

}
