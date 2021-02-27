<?php

require 'vendor/autoload.php';
include '_src/Settings.php';

header('Access-Control-Allow-Origin: *');
header("Content-type: application/json; charset=utf-8");
header("Access-Control-Allow-Credentials: true");

class PESM
{
	protected $container;

	public function __construct($container){
		$this->container = $container;
	}
	
	public function init(){
		//$post = json_decode(file_get_contents('php://input'), true);
		//$post['mac'] = $_GET['mac'];

		$code = $_GET['code'];
		$mac = $_GET['mac'];

		if($chaves = $this->container->db(true)->select('chaves',[
			'id',
			'code',
			'mac',
			'status',
			'del'
		],[
			'AND' => [
				'code[===]' => $code
			]
		]))
		{
			// Se for o primeiro acesso
			//Então apenas registra o MAC ADDRRESS DA MAQUINA
			if($chaves[0]['status'] === '1')
			{
				if($data = $this->container->db(true)->update("chaves", [
					"status" => 2,
					'mac' => $mac
				], [
					"id[===]" => $chaves[0]['id']
				]))
				{
					//tudo ok retornar certo
					$returnData = [
						'code' => 200,
						'msg' => 'Liberado!'
					];
				}
				else
				{
					//algo deu errado!
					$returnData = [
						'code' => 402,
						'msg' => 'Algo deu errado em nossos servidores!'
					];
				}
			}
			// Se for segundo e demais acessos, então verifica se o mac addrress é igual a chave está ativa
			else
			{
				if($chaves[0]['mac'] === $mac)
				{
					//agora verifica se está bloqueado ou ativo
					if($chaves[0]['del'] === '0')
					{
						//está tudo ok
						$returnData = [
							'code' => 200,
							'msg' => 'Liberado!'
						];
					}
					else
					{
						//essa chave foi bloqueada
						$returnData = [
							'code' => 402,
							'msg' => 'Essa chave foi bloqueada'
						];
					}
				}
				else
				{
					//Essa chave já pertence a outra pessoa!
					$returnData = [
						'code' => 402,
						'msg' => 'Essa chave já esta em uso!'
					];		
				}
			}
			
		}
		else
		{
			//essa chave não existe!
			$returnData = [
				'code' => 402,
				'msg' => 'Chave inválida!'
			];
		}

		echo json_encode($returnData, JSON_UNESCAPED_UNICODE);
	}

	

	public function char($text){
		return html_entity_decode($text);
	}
}

$app = new PESM($Settings);
$app->init();



?>