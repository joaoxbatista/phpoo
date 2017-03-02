<?php
	require_once '../vendor/autoload.php';
	require_once '../classes/Usuario.php';
	require_once '../classes/CrudUsuario.php';
	require_once '../classes/Mensagem.php';

	$alerta = new Mensagem();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Atualizar usuário</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="col-md-8 col-md-offset-2" style="margin-top: 50px;"">
			<?php
				/**
				*Atualizar usuários
				*/

				if (isset($_GET['id'])):
					$crud = new CrudUsuario();
					$usuario = $crud->procurar($_GET['id']);

					if(isset($_POST['update-usuario'])):
						if(!empty($_POST['nome']) and !empty($_POST['email'])):

							$crud = new CrudUsuario();
							$crud->editar([
								'id' => $_POST['id'],
								'nome' => $_POST['nome'],
								'email' => $_POST['email']
							]);
							header("Location:editar.php?id=$usuario->id");
						else:
							echo $alerta->erro("Preencha todos os campos");
						
						endif;
					endif;
				endif;
			?>
			
			<!-- Formulário de Atualização -->
			<div class="row" style="margin-bottom: 50px;">
				<form action="" method="POST" class="form">
					<input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
					<div class="form-group">
						<label for="nome">Nome</label>
						<input type="text" value="<?php echo $usuario->nome; ?>" name="nome" class="form-control" required> 
					</div>

					<div class="form-group">
						<label for="email">E-mail</label>
						<input type="email" value="<?php echo $usuario->email; ?>" name="email" class="form-control" required>
					</div>
						<button type="submit" name="update-usuario" class="btn btn-primary">Atualizar</button>	
				</form>
			</div>
		
		</div>
	</div>

	<!-- Scripts -->
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

