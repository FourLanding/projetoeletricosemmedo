<?php
include '../vendor/autoload.php';
include '../_src/Settings.php';
//restringir pageina
$Settings->protect();

$title = 'Painel | PESM';
$page = 'painel';
include '_parts/header.php';

?>

<section class="mt-4">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card border-0 shadow">
					<div class="card-header bg-white d-flex">
						<div>
							<img src="../assets/img/logo.png" height="40" alt="">
							<p class="text-muted text-center text-uppercase mb-0 small"><strong>Chaves de acesso</strong></p>
						</div>
						<div class="ml-auto">
							<ul class="m-0 p-0">
								<li class="d-inline-block p-2">
									<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#CreateNewPass">Nova Chave</button>
								</li>
								<li class="d-inline-block p-2">
									<a href="logout.php" class="text-decoration-none">Sair</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="card-body">
						<div class="form-group">
							<input type="text" placeholder="Pesquisar Email ou Chave..." class="form-control" id="searchUser">
						</div>
						<div class="divider"></div>

						<div class="w-100 position-relative">
							<div class="tapa h-100 d-flex align-items-center">
								<div class="lds-ring mr-auto ml-auto"><div></div><div></div><div></div><div></div></div>
							</div>
							<table class="table" id="tableList">
								
							  <thead class="thead-dark">
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Email</th>
							      <th scope="col">Chave</th>
							      <!--<th scope="col">MAC</th>-->
							      <!--<th scope="col">Status</th>-->
							      <th scope="col">Status</th>
							      <!--<th scope="col">Data</th>-->
							      <th scope="col">Ação</th>
							    </tr>
							  </thead>
							  <tbody id="listar"></tbody>
							</table>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<!-- Modal -->
<div class="modal fade" id="CreateNewPass" tabindex="-1" aria-labelledby="CreateNewPassLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CreateNewPassLabel">Criar nova Chave</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="alert d-none" role="alert" id="msgGerate"></div>
    	<div class="form-group">
    		<input type="email" id="emailUsPass" placeholder="Email" class="form-control">
    	</div>
      </div>
      <div class="modal-footer">
        <button type="button" id="createNew" class="btn btn-primary btn-block">Gerar Chave</button>
      </div>
    </div>
  </div>
</div>

<?php
include '_parts/footer.php';
?>