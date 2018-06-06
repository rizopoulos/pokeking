<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PokemonProfile extends Model {

	public function pokemon() {
		return $this->belongsTo( 'App\Pokemon' );
	}

}