<?php


require 'conexion.php';
sleep(2);
$usuarios = $mysqli-> query("SELECT nombres, tipo FROM login WHERE usuario = '".$_POST['usua']."' AND password = '".$_POST['contra']."'");

if ($usuarios->num_rows==1){
	$datos = $usuarios-> fetch_assoc();
	echo json_encode(array('error'=>false,'tipo'=>$datos['tipo_usua']));}
else{
	 echo json_encode(array('error'=>true));}
endif;

$mysqli->close();
 ?>
