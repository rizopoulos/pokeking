<?php

namespace App\Http\Controllers;

use App\PokemonProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PokemonsController extends Controller {

	public function index() {
		$pokemons = PokemonProfile::has( 'pokemon' )
		                          ->orderBy( DB::raw( 'height/weight' ), 'desc' )
		                          ->paginate( 5 );

		return view( 'pokemons.index', compact( 'pokemons' ) );
	}

	public function king( Request $request ) {
		return 1;
	}
}
