<?php

use Illuminate\Database\Seeder;
use GuzzleHttp\Client;
use GuzzleHttp\Promise as GuzzlePromise;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;

class PokemonProfilesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$client = new Client( [
			'timeout' => 0,
			'verify'  => false
		] );

		$pokemons = DB::table( 'pokemons' )->get();
		if ( empty( $pokemons ) ) {
			return;
		}

		$requests = function ( $pokemons ) {
			foreach ( $pokemons as $pokemon ) {
				yield new Request( 'GET', $pokemon->url );
			}

		};

		$pool = new Pool( $client, $requests( $pokemons ), [
			'concurrency' => 10,
			'fulfilled'   => function ( $response, $index ) {
				// this is delivered each successful response
				if ( $response->getStatusCode() == 200 ) {
					$data = json_decode( $response->getBody() );
					if ( $data->height >= 50 && ( ! empty( $data->sprites->front_default ) ) ) {
						// if pokemon already exists don't insert
						if ( DB::table( 'pokemon_profiles' )->where( 'pokemon_id', $data->id )->exists() ) {
							return;
						}
						echo "Ready to insert response $index \n";
						$record = [
							'pokemon_id'      => $data->id,
							'sprite'          => $data->sprites->front_default,
							'base_experience' => $data->base_experience,
							'height'          => $data->height,
							'weight'          => $data->weight,
							'info'            => json_encode( $data, JSON_UNESCAPED_UNICODE ),
							'created_at'      => \Carbon\Carbon::now()->toDateTimeString(),
						];
						DB::table( 'pokemon_profiles' )->insert( $record );
					}
				}
			},
			'rejected'    => function ( $reason ) {
				// this is delivered each failed request
				// echo $reason . "\n";
			},
		] );
		// Initiate the transfers and create a promise
		$promise = $pool->promise();

		// Force the pool of requests to complete.
		$promise->wait( false );
	}
}
