<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PokemonProfile extends Model {

	protected $appends = [
		'base_stat'
	];

	protected $casts = [
		'info' => 'array',
	];

	public function pokemon() {
		return $this->belongsTo( 'App\Pokemon' );
	}

	/**
	 * Calculate the Pokemon's total 'base_stat'
	 *
	 * @return int
	 */
	public function getTotalStats() {
		$base_stat = 0;
		foreach ( $this->info['stats'] as $stat ) {
			$base_stat += $stat['base_stat'];
		}

		return $base_stat;
	}

	/**
	 * Virtual field for 'base_stat'
	 *
	 * @return int
	 */
	public function getBaseStatAttribute() {
		return $this->getTotalStats();
	}
}