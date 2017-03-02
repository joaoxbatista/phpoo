<?php
	
	class Mensagem{

		public function sucesso($mensagem){
			return "<div class='alert alert-success'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<strong>Sucesso! </strong>".$mensagem.
			"</div>";
		}

		public function erro($mensagem){
			return "<div class='alert alert-danger'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<strong>Erro! </strong>".$mensagem.
			"</div>";
		}
	}