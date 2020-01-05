<?php 
	//verificar se os dados foram enviados
	if ( $_POST ) {
		foreach ($_POST as $key => $value) {
			$$key = trim ( $value );
		}
		
		$pdo->beginTransaction();
		//se o id for vazio insere - se não update!
		if ( empty ( $id ) ) {		
			//insert
			$sql = "insert into tamanho 
			(id, descricao, peso, largura, comprimento, altura)
			values 
			(NULL, :descricao, :peso, :largura, :comprimento, :altura)";
			$consulta = $pdo->prepare( $sql );			
			$consulta->bindValue(":descricao",$descricao);
			$consulta->bindValue(":peso",$peso);
			$consulta->bindValue(":largura",$largura);
			$consulta->bindValue(":comprimento",$comprimento);
			$consulta->bindValue(":altura",$altura);			
		} else if ( empty ( $id ) ) {			
			//update
			$sql = "update tamanho set descricao = :descricao, peso = :peso, largura = :largura, 
			comprimento = :comprimento, altura = :altura
				where id = :id limit 1";
			$consulta =  $pdo->prepare($sql);
			$consulta->bindValue(":descricao",$descricao);
			$consulta->bindValue(":peso",$peso);
			$consulta->bindValue(":largura",$largura);
			$consulta->bindValue(":comprimento",$comprimento);
			$consulta->bindValue(":altura",$altura);
			$consulta->bindValue(":id", $id);
		} else {
			//criptografar a senha
		
			//update
			$sql = "update tamanho set descricao = :descricao, peso = :peso, largura = :largura, 
			comprimento = :comprimento, altura = :altura
				where id = :id limit 1";
			$consulta =  $pdo->prepare($sql);
			$consulta->bindValue(":descricao",$descricao);
			$consulta->bindValue(":peso",$peso);
			$consulta->bindValue(":largura",$largura);
			$consulta->bindValue(":comprimento",$comprimento);
			$consulta->bindValue(":altura",$altura);
			$consulta->bindValue(":id", $id);
		}
		//executar
		if ( $consulta->execute() ) {			
			//salvar no banco
			$pdo->commit();

			$msg = "sucesso!";
			sucesso( $msg, "listar/tamanho" );

		} else {
			//erro do sql
			echo $consulta->errorInfo()[2];
			exit;
			$msg = "Erro ao cadastrar tamanho";
			mensagem( $msg );
		}
	}

	