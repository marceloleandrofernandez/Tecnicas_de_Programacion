<?php

	$host="localhost";
	$user= "root";
	$pass="";
	$db="sistgestion";

	class BaseDatos 
		{
			private $con;

			public function conectar(){
				include_once("constantes.php");
				$this->con = new Mysqli($host,$user,$pass,$db);

				if ($this->con) {
					# code...
					return $this->con;
				}
				return "FALLO AL CONECTAR CON LA BASE DE DATOS";					
			}
	}

?>