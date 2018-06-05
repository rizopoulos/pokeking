<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PokemonsTableSeeder extends Seeder {
	/**
	 * Table name
	 *
	 * @var string
	 */
	protected $name = 'pokemons';

	/**
	 * GuzzleHttp instance
	 *
	 * @var null
	 */
	protected $client = null;

	/**
	 * @var string
	 */
	protected $endpoint = 'https://pokeapi.co/api/v2/pokemon/';

	/**
	 * Store the data fetched from $endpoint for future use
	 *
	 * @var array
	 */
	protected $pokemons = [];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$this->client = new \GuzzleHttp\Client();
		$this->getPokemons( $this->endpoint, [ 'limit' => 300, 'offset' => 0 ] );

		foreach ( $this->pokemons as &$pokemon ) {
			// if pokemon with the same url already exists, continue to next result
			if ( DB::table( $this->name )->where( 'url', $pokemon->url )->exists() ) {
				continue;
			}
			// validate data
			if ( empty( $pokemon->name ) || empty( $pokemon->url ) ) {
				continue;
			}

			// insert pokemon data
			DB::table( $this->name )->insert( [
				'name'       => $pokemon->name,
				'url'        => $pokemon->url,
				'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			] );
		}
	}

	/**
	 * Get all pokemon data for the given $url
	 * with the passed query string $params
	 * If the $next property is set in the response, recursively call getPokemons()
	 *
	 * @param string $url
	 * @param array $params
	 */
	protected function getPokemons( string $url = '', array $params = [] ) {
		if ( empty( $url ) ) {
			$url = $this->endpoint;
		}
		echo "GET $url \n";

		$response = $this->client->request( 'GET', $url, [
			'query'  => $params,
			'verify' => false,
		] );
		$response = $response->getBody()->getContents();
		$data     = json_decode( $response );

		// concat current pokemon data with the rest of them stored in $this->pokemons
		if ( ! empty( $data->results ) ) {
			$this->pokemons = array_merge( $this->pokemons, $data->results );
		}

		// check if next url exists and is valid
		if ( ! empty( $data->next ) && filter_var( $data->next, FILTER_VALIDATE_URL ) !== false ) {
			// get the query data from the $data->next url and create an array for $this->getPokemons()
			parse_str( parse_url( $data->next, PHP_URL_QUERY ), $query );
			$this->getPokemons( $data->next, $query );
		}
	}
}
