<?php 
	//verificar se os dados foram enviados
	if ( $_POST ) {
		foreach ($_POST as $key => $value) {
			$$key = trim ( $value );
		}
		
		$pdo->beginTransaction();
		//se o id for vazio insere - se não update!
		if ( empty ( $id ) ) {			//criptografar a senha
		
			//insert
			$sql = "insert into usuario 
			(id, ativo)
			values 
			(NULL, :ativo)";
			$consulta = $pdo->prepare( $sql );			
			$consulta->bindValue(":ativo",$ativo);
		} else if ( empty ( $id ) ) {			
			//update
			$sql = "update usuario set ativo = :ativo 
				where id = :id limit 1";
			$consulta =  $pdo->prepare($sql);
			$consulta->bindValue(":ativo",$ativo);
			$consulta->bindValue(":id", $id);
		} else {
			//criptografar a senha
		
			//update
			$sql = "update usuario set ativo = :ativo
				where id = :id limit 1";
			$consulta =  $pdo->prepare($sql);
			$consulta->bindValue(":ativo",$ativo);
			$consulta->bindValue(":id", $id);
		}
		//executar
		if ( $consulta->execute() ) {			
			//salvar no banco
			$pdo->commit();

			$msg = "sucesso!";
			sucesso( $msg, "listar/ativarcliente" );

		} else {
			//erro do sql
			echo $consulta->errorInfo()[2];
			exit;
			$msg = "Erro ao ativar motorista";
			mensagem( $msg );
		}
	}

	