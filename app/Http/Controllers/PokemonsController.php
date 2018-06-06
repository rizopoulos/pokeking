<?php

namespace App\Http\Controllers;

use App\PokemonProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Psy\debug;

class PokemonsController extends Controller {

	public function index() {
		$pokemons = PokemonProfile::has( 'pokemon' )
		                          ->orderBy( DB::raw( 'height/weight' ), 'desc' )
		                          ->paginate( 5 );

		return view( 'pokemons.index', compact( 'pokemons' ) );
	}

	public function king() {
		return PokemonProfile::all()->sortBy( function ( $item ) {
			return $item->base_stat;
		}, SORT_REGULAR, true )->first();
	}
}
