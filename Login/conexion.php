
<?php
// Conectando, seleccionando la base de datos
    $mysqli = new mysqli ('localhost', 'root', '', 'koky');
    if ($mysqli->connect_errno):
       echo "Error al conectarse con MySQL debido al error ".$mysqli->connect_error;
	  endif;
    //Caso contrario, ejecutas el resto del código

?>
