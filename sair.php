<?php
	//iniciar a sessao
	session_start();
	//apagar a sessao
	unset($_SESSION["tcc"]);
	//redirecionar para o index
	header("Location: index.php");