<?php
require_once 'Database.php';
require_once 'Usuario.php';
require_once 'Mensagem.php';
class CrudUsuario{

	public $db;
	public $msg;
	public function __construct(){
		$this->db = Database::getConexao();
		$this->msg = new Mensagem();
	}

	//Cadastrar Usuários
	public function cadastrar($usuario){
		try {

			$stmt = $this->db->prepare('insert into usuarios(nome, email, senha) values(:nome, :email, :senha)');
			$usuario['senha'] = md5($usuario['senha']);
			$stmt->bindParam(':nome', $usuario['nome']);
			$stmt->bindParam(':email', $usuario['email']);
			$stmt->bindParam(':senha', $usuario['senha']);
			$stmt->execute();

			echo $this->msg->sucesso("Usuário cadastrado com sucesso.");

		} catch (PDOException $e) {
			if ($e->getCode() == 23000){
				echo $this->msg->erro("E-mail já existente.");
			}else{
				echo $this->msg->erro($e->getMessage());
			}
		}
	}

	//Deletar Usuários
	public function deletar($id){
		try{
			$stmt = $this->db->prepare('DELETE FROM usuarios WHERE id=:id');
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				echo $this->msg->sucesso("Usuário apagado com sucesso.");
			}else{
				echo $this->msg->erro("Usuário inexistente.");
			}
		}
		catch(PDOException $e){
			echo $this->msg->erro($e->getMessage());
		}
	}

	//Editar Usuários
	public function editar($usuario){
		try{
			$stmt = $this->db->prepare("UPDATE usuarios set nome = :nome, email = :email where id = :id");
			$stmt->bindParam(':nome', $usuario['nome']);
			$stmt->bindParam(':email', $usuario['email']);
			$stmt->bindParam(':id', $usuario['id']);
			$stmt->execute();

			if($stmt->rowCount() > 0){
				echo $this->msg->sucesso("Os dados do usuário foram alterados com sucesso."); 
			}
		}
		catch(PDOException $e){
			echo $this->msg->erro($e->getMessage());
		}
	}

	//Procurar Usuários
	public function procurar($id){
		try {
			$stmt = $this->db->prepare('select * from usuarios where id = :id');
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();

			if($stmt->rowCount() > 0){
				return $stmt->fetchObject();
			}else{
				echo '[ Erro ] - usuário não encontrado';
			}
		} catch (PDOException $e) {
			echo $this->msg->erro($e->getMessage());
		}
	}


	public function procurarTodos(){
		try {
			$stmt = $this->db->prepare('select * from usuarios');
			$stmt->execute();
			return $stmt->fetchAll();

		} catch (PDOException $e) {
			echo $this->msg->erro($e->getMessage());
		}
	}
}