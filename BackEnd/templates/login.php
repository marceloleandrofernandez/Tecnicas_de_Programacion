<?php

$email=$_POST['mail'];
$password = $_POST['contra'];

if (isset($_POST['nick'])) {
	$nick = $_POST['nick'];
	$tipous = 1;
	}
echo (contra);
class Login 
{
	
	function __construct()
	{
		include_once('../baseDatos/db.php');
		$db = new BaseDatos();
		$this->con = $db->conectar();
		/* Prueba si se realiza la conexion 
 		if ($this->con) {
			echo'Conectado';
		}else{
			echo'No conecto';
		}*/
		# code...
	}
	public function ExisteMail($email){

		$pre_stmt = $this->con->prepare('SELECT `id` FROM `cuentas` WHERE email = ?');
		$pre_stmt->bind_param('s',$email);
		$pre_stmt->execute() or die($this->con->error);
		$resultado = $pre_stmt->get_result();
		if ($resultado->num_rows > 0) {
			echo"Existe";
			return 1;
			# code...
		}else{
			echo "no existe";
			return 0;
		}


	}
	public function crearcuenta($nick, $email, $password, $tipous)
	{	// Para Ataques SQL q(O.o)p
		if ($this->ExisteMail($email)) {
			return "El Correo Ya Esta Registrado";
			# code...
		}else{
				$pass_hash = password_hash($password,PASSWORD_BCRYPT,["cost"=>8]);
				$pre_stmt = $this->con->prepare('INSERT INTO `cuentas`(`nick`, `email`, `passwd`, `tipous`) VALUES (?,?,?,?)');
				$pre_stmt->bind_param('ssss',$nick, $email, $pass_hash, $tipous);
				$resultado=$pre_stmt->execute() or die($this->con->error);
				if ($resultado) {
					echo " Cuenta Creada";
					return $this->con->insert_id;
					# code...
				}else{
					return "Algun Error";
				}
			}
	}

	public function ingresar($email,$password){
		$pre_stmt = $this->con->prepare('SELECT `id`, `nick`, `email`, `passwd`, `tipous` FROM `cuentas` WHERE email = ?');
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();

		if ($result->num_rows < 1) {
			echo"No Registrado";
			return "No Registrado";
			# code...
		}else{
			$row = $result->fetch_assoc();
			if (password_verify($password,$row["passwd"])) {
				session_start();
				$_SESSION["userid"] = $row["id"];
				$_SESSION["username"] = $row["nick"];
				# Agregar tipo para manejar niveles de usuarios...
			}else{
				echo"Password Incorrecto";
				return "PASSWORD_INCORRECTO";
			}

		}

	}

}
$test = new Login();
//$test->crearcuenta("Admin","admin@mail",123456,1);

$test->ingresar($email,$password);

if (isset($_SESSION)) {
	header("location:panel.php");
	# code...
}else{
	header("location:../index.php");
}
//echo $_SESSION["userid"];
//echo $_SESSION["username"];
?>