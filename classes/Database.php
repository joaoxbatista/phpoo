<?php 

	class Database{

		public static function getConexao(){
			try{
				$pdo = new PDO("mysql:host=localhost;dbname=pdo;charset=utf8;", 'root', 'admin');
				$pdo -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				return $pdo;
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	}