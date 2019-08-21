<?php

/**
 *
 * @author Burhan Mafazi | burhanmafazi@gmail.com
 * @copyright 2019 Burhan
 * @version 1.0
 *
 */

namespace App\Helpers;

class Data
{
	private static $instance = null;

	function __construct() {

	}

	public static function getInstance()
	{
		if(self::$instance == null)
		{
			self::$instance = new Data();
		}

		return self::$instance;
	}

	public function getData($model, $column, $filter, $value = NULL)
	{
		if ($value != NULL) {
			return $model::where($column, $value)->orderBy($column, $filter)->get();				
		} else {			
			return $model::orderBy($column, $filter)->get();
		}
	}
}