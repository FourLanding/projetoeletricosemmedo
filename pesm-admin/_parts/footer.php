<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<?php
	if($page === 'login')
	{
?>
	<script>
		$("#login").on('submit', function(e) {
			e.preventDefault();
			$.ajax({
				url: '/pesm-admin/ajax/auth.php',
				type: 'POST',
				data: {
					usMail: $("#usMail").val(),
					usPass: $("#usPass").val()
				},
			})
			.done(function(res) {
				if(res.code)
				{
					$("#msgLogin")
					.removeClass('alert-warning')
					.addClass('alert-primary')
					.removeClass('d-none')
					.addClass('d-block')
					.html(res.msg);

					setTimeout(function(){
						window.open('/pesm-admin/', '_self');
					},500);
				}
				else
				{
					//exibir msg
					$("#msgLogin")
					.removeClass('alert-primary')
					.addClass('alert-warning')
					.removeClass('d-none')
					.addClass('d-block')
					.html(res.msg);
				}

				setTimeout(function(){
					$("#msgLogin")
					.removeClass('d-block')
					.addClass('d-none');
				},3000);
			})
			.fail(function() {
				//console.log("error");
			})
			.always(function() {
				//console.log("complete");
			});
			
		});
	</script>
<?php
	}
	else if($page === 'painel')
	{
?>
	
	<script>
		$('#CreateNewPass').on('hidden.bs.modal', function (e) {
		  // do something...
		  $("#msgGerate")
			.removeClass('alert-danger')
			.removeClass('alert-primary')
			.removeClass('d-block')
			.addClass('d-none');
		});
		$("#createNew").on('click', function(e) {
			e.preventDefault();
			var email = $("#emailUsPass").val();

			$.ajax({
				url: '/pesm-admin/ajax/chaves.php?action=create',
				type: 'POST',
				data: {pMail: email},
			})
			.done(function(res) {
				if(res.code)
				{
					$("#msgGerate")
					.removeClass('alert-danger')
					.addClass('alert-primary')
					.removeClass('d-none')
					.addClass('d-block')
					.html(res.msg+' '+res.data);
					$("#emailUsPass").val("");
					listar();
				}
				else
				{
					//exibir msg de erro
					$("#msgGerate")
					.removeClass('alert-primary')
					.addClass('alert-danger')
					.removeClass('d-none')
					.addClass('d-block')
					.html(res.msg);
				}
			})
			.fail(function() {
				//console.log("error");
			})
			.always(function() {
				//console.log("complete");
			});
			
		});

		$("#searchUser").keyup(function(e) {
			var pes = $(this).val();

			if(pes.length >= 4)
			{
				listar(pes);
			}
			else if(pes.length == 0)
			{
				listar();
			}
		});
		function listar(search = null){
			$('.tapa').removeClass('d-none').addClass('d-flex');
			var url = '';
			if(search != null)
			{
				url = '/pesm-admin/ajax/chaves.php?buscar='+search;
			}
			else{
				url = '/pesm-admin/ajax/chaves.php';
			}

			$.ajax({
				url: url,
				type: 'GET',
			})
			.done(function(res) {

				if(res.code)
				{
					var htmlList = '';
					$.each(res.data, function(index, val) {
						 console.log(val);
						 var blq = '';
						 var bb = '';
						 if(val.del == 0)
						 {
						 	blq = '<span class="badge badge-success">Ativo</span>';
						 	bb = '<button class="btn btn-smx btn-outline-danger" onclick="actionDesAndBloc(1, '+val.id+');">Bloquear</button>';
						 }
						 else
						 {
						 	blq = '<span class="badge badge-danger">Bloqueado</span>';
						 	bb = '<button class="btn btn-smx btn-outline-success" onclick="actionDesAndBloc(2, '+val.id+');">Desbloquear</button>';
						 }
						htmlList += '<tr>';
					      htmlList += '<th scope="row">'+val.id+'</th>';
					      htmlList += '<td>'+val.email+'</td>';
					      htmlList += '<td><span class="cursor-pointer" onclick="copyToClipboard(this);" title="Clique para Copiar">'+val.code+'</span></td>';
					      //htmlList += '<td>'+val.mac+'</td>';
					      //htmlList += '<td>'+val.status+'</td>';
					      htmlList += '<td>'+blq+'</td>';
					      htmlList += '<td>'+bb+'</td>';
					      //htmlList += '<td>'+val.date_created+'</td>';
					    htmlList += '</tr>';
					});




					
					/*$('.copyButton').click(function(e) {
						var target = $(this).attr('data-copy');
						copyToClipboard($(target));
					});*/
					$("#listar").html(htmlList);
				}
				else
				{
					$("#listar").html("<h4 class='text-center text-muted'>"+res.msg+"</h4>");
				}

				setTimeout(function(){
					$('.tapa').removeClass('d-flex').addClass('d-none');
				},500);
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		}


		listar();

		function actionDesAndBloc(ci, id){
			$.ajax({
				url: '/pesm-admin/ajax/chaves.php?action=del',
				type: 'POST',
				data: {id: id, type: ci},
			})
			.done(function(res) {
				if(res.code)
				{
					listar();
				}
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		}
		function copyToClipboard(element) {
		    var $temp = $("<input>");
		    $("body").append($temp);
		    $temp.val($(element).text()).select();
		    document.execCommand("copy");
		    $temp.remove();
		}
		


	</script>

<?php
}
?>



  </body>
</html>	