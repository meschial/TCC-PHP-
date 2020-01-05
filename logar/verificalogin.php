<?php
	//verifica se a sessao esta ativa
	//verifica se existe o id na sessao hqs
	if(isset($_SESSION["tcc"]["id"])){		
	}
	if(!isset($_SESSION["tcc"]["id"])){
		echo "<script>location.href='index.php'</script>";
		exit;
	}	
 ?>