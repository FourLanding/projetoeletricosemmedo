<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

date_default_timezone_set('America/Sao_Paulo');

use Medoo\Medoo;
class Settings
{
	public function protect()
	{
		if(!isset($_SESSION['uAdmin']) || empty($_SESSION['uAdmin']) && 
			!isset($_SESSION['logged']) || empty($_SESSION['logged']))
		{
			header("Location: login.php");
		}
	}

	public function db($d = null){
		$db = '_src/@PESM/@db/_PESM.db';
		if($d === null)
		{
			$db = '../../_src/@PESM/@db/_PESM.db';
		}
		$database = new Medoo([
			'database_type' => 'sqlite',
			'database_file' => $db,
			//'database_name' => 'main',
			//'username' => 'root',
			//'password' => '@17071995'
		]);
		return $database;
	}
}

$Settings = new Settings;
//$_SESSION['uAdmin'] = 'ok';
