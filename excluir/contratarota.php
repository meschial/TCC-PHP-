<?php
//verificar se esta sendo enviado o id
	if ( isset ( $p[2] ) ) {
		$id = (int)$p[2];
		//excluir a editora
		$sql = "delete from item where iditem = ? limit 1";
		$consulta = $pdo->prepare( $sql );
		$consulta->bindParam(1,$id);
		//verificar se o registro foi excluido
		if ( $consulta->execute() ) {
			$msg = "Envio excluído com sucesso";
			mensagem ( $msg );
		} else {
			$msg = "Erro ao excluir Envio";
			mensagem( $msg );
		}
	}    else {
			$msg = "Ocorreu um erro ao excluir";
			mensagem( $msg );
	}