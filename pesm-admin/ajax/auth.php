<?php
require '../../vendor/autoload.php';
require '../../_src/Settings.php';

header("Content-type: application/json; charset=utf-8");
use Medoo\Medoo;
use Respect\Validation\Validator as v;

class Auth
{
	protected $container;

	public function __construct($container){
		$this->container = $container;
	}

	public function login()
	{
		//validar dados
		if(!empty($_POST['usMail']) && !empty($_POST['usPass']))
		{
			if(v::email()->validate($_POST['usMail']))
			{
				//validar senha
				if(v::stringType()->length(8, null)->validate($_POST['usPass']))
				{
					//validar no banco de dados
					if($this->container->db()->select('admins',[
						'id'
					],[
						'email[===]' => $_POST['usMail']
					]))
					{
						//succeso
						if($admin = $this->container->db()->select('admins',[
							'id'
						],[
							'email[===]' => $_POST['usMail'],
							'password[===]' => $_POST['usPass']
						]))
						{
							$_SESSION['uAdmin'] = $admin[0]['id'];
							$_SESSION['logged'] = 1;
							return [
								'code' => true,
								'msg' => 'Logado com sucesso!'
							];
						}
						else
						{
							return [
								'code' => false,
								'msg' => 'Senha incorreta!'
							];
						}
					}
					else
					{
						return [
							'code' => false,
							'msg' => 'Email Não cadastrado!'
						];
					}
				}
				else
				{
					return [
						'code' => false,
						'msg' => 'A senha deve ter no minimo 8 caractéries'
					];
				}
			}
			else
			{
				return [
					'code' => false,
					'msg' => 'Preencha um email válido'
				];
			}
		}
		else
		{
			return [
				'code' => false,
				'msg' => 'Preencha todos os campos'
			];
		}

	}
}

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$auth = new Auth($Settings);
	echo json_encode($auth->login());
}
else
{
	//method invalid
	$returnType = [
		'code' => false,
		'msg' => 'Requisição Inválida'
	];
	echo json_encode($returnType);
}