<?php 
	//verificar se os dados foram enviados
	if ( $_POST ) {
		foreach ($_POST as $key => $value) {
			$$key = trim ( $value );
		}

		if ( empty( $cpf ) ) {
			echo "<script>alert('Preencha o CPF');history.back();</script>";
			exit;
		}
		else if ( validaCPF($cpf) != 1 ) {
			echo "<script>alert('CPF inválido');history.back();</script>";
			exit;
		}

		//datas
		$data = formataData( $data );
		//verificar se existe alguem com o mesmo cpf
		if ( empty ( $id ) ) {
			//se existe alguem, qualquer um, com o mesmo cpf
			$sql = "select id, nome from usuario where cpf = ? limit 1";
			$consulta = $pdo->prepare( $sql );
			$consulta->bindParam(1,$cpf);
		} else {
			//se existe alguem, menos ele mesmo, com o mesmo cpf
			$sql = "select id, nome from usuario where cpf = ? and id <> ? limit 1";
			$consulta = $pdo->prepare( $sql );
			$consulta->bindParam(1,$cpf);
			$consulta->bindParam(2,$id);
		}
		//executar o sql
		$consulta->execute();
		$dados = $consulta->fetch(PDO::FETCH_OBJ);
		//verificar se o dados trouxe algum resultado
		if ( isset ( $dados->id ) ) {
			$msg = "Esse CPF ja está cadastrado na base de dados";
			mensagem($msg);
		}
		$pdo->beginTransaction();
		//se o id for vazio insere - se não update!
		if ( empty ( $id ) ) {
			//criptografar a senha
			$senha = password_hash($senha, PASSWORD_DEFAULT);
			//insert
			$sql = "insert into usuario 
			(id, nome, cpf, rg, data, email, senha, tipo, celular, celular2, apelido, ativo)
			values 
			(NULL, :nome, :cpf, :rg, :data, :email, :senha, :tipo, :celular, :celular2, :apelido, :ativo)";
			$consulta = $pdo->prepare( $sql );
			$consulta->bindValue(":nome",$nome);
			$consulta->bindValue(":cpf",$cpf);
			$consulta->bindValue(":rg",$rg);
			$consulta->bindValue(":data",$data);
			$consulta->bindValue(":email",$email);
			$consulta->bindValue(":senha",$senha);			
			$consulta->bindValue(":tipo",$tipo);
			$consulta->bindValue(":celular",$celular);
			$consulta->bindValue(":celular2",$celular2);
			$consulta->bindValue(":apelido",$apelido);
			$consulta->bindValue(":ativo",$ativo);
			
		} else if ( empty ( $senha ) ) {			
			//update
			$sql = "update usuario set nome = :nome,
				cpf = :cpf, rg = :rg, data = :data,
				email = :email, senha = :senha, tipo = :tipo,
				celular = :celular, celular2 = :celular2, apelido = :apelido
				where id = :id limit 1";
			$consulta =  $pdo->prepare($sql);
			$consulta->bindValue(":nome",$nome);
			$consulta->bindValue(":cpf",$cpf);
			$consulta->bindValue(":rg",$rg);
			$consulta->bindValue(":data",$data);
			$consulta->bindValue(":email",$email);			
			$consulta->bindValue(":senha",$senha);
			$consulta->bindValue(":tipo",$tipo);
			$consulta->bindValue(":celular",$celular);
			$consulta->bindValue(":celular2",$celular2);
			$consulta->bindValue(":apelido",$apelido);
			$consulta->bindValue(":id", $id);
		} else {
			//criptografar a senha
			$senha = password_hash($senha, PASSWORD_DEFAULT);
			//update
			$sql = "update usuario set nome = :nome,
				cpf = :cpf, rg = :rg, data = :data,
				email = :email, senha = :senha, tipo = :tipo,
				celular = :celular, celular2 = :celular2, apelido = :apelido
				where id = :id limit 1";
			$consulta =  $pdo->prepare($sql);
			$consulta->bindValue(":nome",$nome);
			$consulta->bindValue(":cpf",$cpf);
			$consulta->bindValue(":rg",$rg);
			$consulta->bindValue(":data",$data);
			$consulta->bindValue(":email",$email);			
			$consulta->bindValue(":senha",$senha);
			$consulta->bindValue(":tipo",$tipo);
			$consulta->bindValue(":celular",$celular);
			$consulta->bindValue(":celular2",$celular2);
			$consulta->bindValue(":apelido",$apelido);
			$consulta->bindValue(":id", $id);
		}
		//executar
		if ( $consulta->execute() ) {			
			//salvar no banco
			$pdo->commit();

			$msg = "Registro inserido com sucesso!";
			sucesso( $msg, "listar/listar" );

		} else {
			//erro do sql
			echo $consulta->errorInfo()[2];
			exit;
			$msg = "Erro ao salvar cliente";
			mensagem( $msg );
		}
	}

	