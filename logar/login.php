<?php
	
$msg = "";
	//verificar se foi dado um $_POST
	if ( $_POST ) {
		$cpf = $senha = "";
		if ( isset ( $_POST["cpf"] ) )
			$cpf = trim ( $_POST["cpf"] );
		if ( isset ( $_POST["senha"] ) ) 
			$senha = trim ( $_POST["senha"] );

		if ( empty ( $cpf ) ) {			
			//verificar se o login esta em branco
			$msg = "Digite seu CPF!";
			mensagem($msg);
		} else if ( empty ($senha ) ) {
			//verificar se a senha está em branco
			$msg = "Digite sua Senha";
			mensagem($msg);
		} else {
			//login e a senha foram preenchidos
			//buscar o usuario no banco
			$sql = "select id, nome, email, senha, tipo, ativo, apelido
				from usuario
				where cpf = ? 				
				limit 1";
			//preparar o sql para execução
			$consulta = $pdo->prepare($sql);
			//passar o parametro
			$consulta->bindParam(1, $cpf);
			//executar
			$consulta->execute();

			//recuperar os dados da consulta
			$dados = $consulta->fetch(PDO::FETCH_OBJ);

			if ( isset ( $dados->id ) ) {
				//verificar se trouxe algum resultado

				if ( !password_verify( $senha, $dados->senha ) ) {
					//verificando se a senha não é verdadeira
					$msg = "Senha inválida";
					mensagem($msg);
				} else {

					//guardar alguns dados na sessao
					$_SESSION["tcc"] = array(
						"id"=>$dados->id,						
						"tipo"=>$dados->tipo,
						"apelido"=>$dados->apelido,
						"ativo"=>$dados->ativo,
						"nome"=>$dados->nome						
					);
					//print_r( $_SESSION["tcc"] );

					//redirecionar a tela para o home
					//com javascript
					if ( "1" == $_SESSION["tcc"]["tipo"]) {
						echo "<script>location.href='paginas/cliente'</script>";
					}else{
						echo "<script>location.href='paginas/motorista'</script>";
					}					 
					exit;
				}
			} else {
				//se nao trouxe resultado
				$msg = "Usuário inexistente ou desativado";
				mensagem($msg);
			}
		}
	}
?>