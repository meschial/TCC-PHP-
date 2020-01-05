<?php
//verifica se esta logado
if ( file_exists ( "logar/verificalogin.php" ) )
		include "logar/verificalogin.php";
	else
		include "../logar/verificalogin.php";

	//verifica se é cliente
	if ( "1" == $_SESSION["tcc"]["tipo"]) {
		echo "é cliente";
	}else{
		echo "<script>location.href='index.php'</script>";
	}	

