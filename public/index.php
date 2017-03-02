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
	<title>Cadastro de usuários</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="col-md-8 col-md-offset-2" style="margin-top: 50px;"">
			
			<?php
				/**
				*Cadastrar usuários
				*/
				if(isset($_POST['form-usuario'])):
					if(!empty($_POST['nome']) and !empty($_POST['email']) and !empty($_POST['senha'])):

						$crud = new CrudUsuario();
						$crud->cadastrar([
							'nome' => $_POST['nome'],
							'senha' => $_POST['senha'],
							'email' => $_POST['email']
						]);

					else:
						echo $alerta->erro("Preencha todos os campos");
					
					endif;
				endif;

			

				/**
				*Deletar usuários
				*/
				if(isset($_GET['action'])):

					/**
					*Deletar usuários
					*/
					if($_GET['action'] == 'deletar' and !empty($_GET['id'])):
					
						$crud = new CrudUsuario();
						$crud->deletar($_GET['id']);
					endif;
				endif;
			?>

			<!-- Formulário de Cadastro -->
			<div class="row" style="margin-bottom: 50px;">
				<form action="" method="POST" class="form">
					<div class="form-group">
						<label for="nome">Nome</label>
						<input type="text" name="nome" class="form-control" required> 
					</div>

					<div class="form-group">
						<label for="email">E-mail</label>
						<input type="email" name="email" class="form-control" required>
					</div>	
					<div class="form-group">
						<label for="senha">Senha</label>
						<input type="password" name="senha" class="form-control" required>
					</div>	
						<button type="submit" name="form-usuario" class="btn btn-primary"> Cadastrar </button>	
				</form>
			</div>

			<!-- Tablea com a listagem de Usuários -->
			<div class="row" style="margin-bottom: 50px;">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>nome</th>
							<th>email</th>
							<th>senha</th>
							<th>ações</th>
						</tr>
					</thead>
					<tbody>
						

						<?php
							$crud = new CrudUsuario();
							$usuarios = $crud->procurarTodos();
							foreach ($usuarios as $usuario): ?>
							
								<tr>
									<td><?php echo $usuario['id']; ?></td>
									<td><?php echo $usuario['nome']; ?></td>
									<td><?php echo $usuario['email']; ?></td>
									<td><?php echo $usuario['senha']; ?></td>
									<td>
										<a href="?action=deletar&id=<?php echo $usuario['id'];?>" class="btn btn-danger btn-block">Deletar</a>
										<a href="editar.php?id=<?php echo $usuario['id'];?>" class="btn btn-warning btn-block">Atualizar</a>
									</td>
								</tr>
						
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Scripts -->
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>