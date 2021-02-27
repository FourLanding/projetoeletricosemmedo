<?php
namespace App\Config;
use Medoo\Medoo;
class Settings {
   //TODO
	public function db(){
		$database = new Medoo([
			'database_type' => 'sqlite',
			'database_file' => '_db/QiQuizDb.db'
		]);

		return $database;
	}
}
