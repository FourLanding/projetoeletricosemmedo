<?php
include '../_src/Settings.php';

$title = 'Login | PESM';
$page = 'login';
include '_parts/header.php';
?>


<section class="h-100 d-flex align-items-center">
	<div class="container">
		<div class="row">
			<div class="offset-md-4 col-md-4">

				<div class="card border-0 p-4 text-center">
					<div class="mr-auto ml-auto text-center mb-3">
						<img src="../assets/img/logo.png" height="40" alt="">
					</div>
					<div class="alert d-none" role="alert" id="msgLogin"></div>
					<form id="login" action="ajax/auth.php" method="POST">
						<div class="form-group">
							<input type="email" placeholder="Email" class="form-control" name="usMail" id="usMail">
						</div>
						<div class="form-group">
							<input type="password" placeholder="Senha" class="form-control" name="usPass" id="usPass">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block">Entrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>


<?php
include '_parts/footer.php';
?>