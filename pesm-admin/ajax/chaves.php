<?php
require '../../vendor/autoload.php';
require '../../_src/Settings.php';

header("Content-type: application/json; charset=utf-8");
use Medoo\Medoo;
use Respect\Validation\Validator as v;

class Chaves
{
	protected $container;

	public function __construct($container){
		$this->container = $container;
	}

	public function listar()
	{
		if(isset($_SESSION['uAdmin']) || !empty($_SESSION['uAdmin']))
		{
			if(isset($_GET['buscar']) && !empty($_GET['buscar']))
			{	
				$param = [
					'OR' => [
						'email[~]' => $_GET['buscar'],
						'code[~]' => $_GET['buscar']
					],
					"ORDER" => ["date_created" => "DESC"]
				];
			}
			else{
				$param = [
					"ORDER" => ["date_created" => "DESC"],
				];
			}
			if($chaves = $this->container->db()->select('chaves',[
				'id',
				'email',
				'code',
				'mac',
				'status',
				'del',
				'date_created'
			],$param))
			{
				return [
					'code' => true,
					'msg' => 'listado',
					'data' => $chaves
				];
			}
			else
			{
				return [
					'code' => false,
					'msg' => 'Nenhuma Chave Cadastrada!'
				];
			}
		}
		else
		{
			return [
				'code' => false,
				'msg' => 'Faça login para continuar'
			];
		}
	}

	public function del(){

		$type='';
		if($_POST['type'] === '1')
		{
			$type = 1;
			$msg = 'Bloqueado!';
		}
		else
		{
			$type = 0;
			$msg = 'Desbloqueado!';
		}

		if($data = $this->container->db()->update("chaves", [
			"del" => $type
		], [
			"id[===]" => $_POST['id']
		]))
		{
			return [
				'code' => true,
				'msg' => $msg
			];
		}

	}

	public function create(){
		// validar email
		if(!empty($_POST['pMail']))
		{
			if(v::email()->validate($_POST['pMail']))
			{
				//verificar se email já existe
				    if ($this->container->db()->has("chaves", [
				    	"AND" => [
				    		"email" => $_POST['pMail']
				    	]
				    ]))
				    {
				    	return [
							'code' => false,
							'msg' => 'Email já existe!'
						];
				    }
				    else
				    {
				    	$gerate = strtoupper(md5($_POST['pMail'].time()));
				    	if($this->container->db()->insert("chaves", [
					    	"email" => $_POST['pMail'],
					    	"code" => $gerate,
					    	"status" => 1,
					    	'del' => 0,
					    	'date_created' => time()
					    ]))
				    	{
				    		return [
								'code' => true,
								'msg' => 'Chave Gerada:',
								'data' => $gerate
							];
				    	}
				    	else
				    	{
				    		return [
								'code' => false,
								'msg' => 'Algo deu errado!'
							];
				    	}
				    }
			}
			else{
				return [
					'code' => false,
					'msg' => 'Email inválido!'
				];
			}
		}
		else
		{
			return [
				'code' => false,
				'msg' => 'Preecha um email'
			];
		}

	}
}

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
	if($_GET['action'] === 'del')
	{
		$chaves = new Chaves($Settings);
		echo json_encode($chaves->del());
	}
	if($_GET['action'] === 'create')
	{
		$chaves = new Chaves($Settings);
		echo json_encode($chaves->create());
	}
	//$auth = new Auth($Settings);
	//echo json_encode($auth->login());
}
else
{
	$chaves = new Chaves($Settings);
	echo json_encode($chaves->listar());
}