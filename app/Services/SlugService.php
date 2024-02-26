<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Str;

class SlugService
{
	// public function __construct() {

	// }

	/**
	 * Return slug for model.
	 *
	 * This function searches for already existent slugs for 
	 * The specificed model and returns an unique slug.
	 * 
	 * @param string $model
	 * @param string $name
	 * 
	 * @return string
	 */
	public static function createForModel(string $model, string $name): string
	{
		$tryCount = 0;

		// Interpret $model to class
		$model = new $model();

		if (!$model instanceof Model) {
			throw new \Exception("Invalid Model.");
		}

		// Slugify
		$slug = Str::slug($name);

		// Check if the slug already exists for the given Model.
		while ((new $model())::where('slug', $slug)->count()) {
			$slug = Str::slug($name) . "-" . ++$tryCount;
		}

		return $slug;
	}
}
