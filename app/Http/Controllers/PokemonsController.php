<?php

namespace App\Http\Controllers;

use App\PokemonProfile;
use Illuminate\Support\Facades\DB;

class PokemonsController extends Controller {

	/**
	 * Pokemons index page
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index() {
		$pokemons = PokemonProfile::has( 'pokemon' )
		                          ->orderBy( DB::raw( 'height/weight' ), 'desc' )
		                          ->paginate( 5 );

		return view( 'pokemons.index', compact( 'pokemons' ) );
	}

	/**
	 * API handler to determine the pokemon king
	 * We are using a virual field for that, see \App\PokemonProfile
	 *
	 * @return mixed
	 */
	public function king() {
		return PokemonProfile::all()->sortBy( function ( $item ) {
			return $item->base_stat;
		}, SORT_REGULAR, true )->first();
	}
}
