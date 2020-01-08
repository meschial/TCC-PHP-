<?php 

  $cliente_id = $_SESSION["tcc"]["id"];

  if ( $_POST ) { 
foreach ($_POST as $key => $value) {
            $$key = trim ( $value );
        }

    $valor = formataValor( $valor );
    $pdo->beginTransaction();


    if ( empty ( $id ) ) {       
     $sql = "insert into venda 
     (id, valor, item_id) 
     values
     (null, :valor, :item_id)";

            //salvar no banco
            $consulta = $pdo->prepare( $sql );
            $consulta->bindValue(":valor",$valor);
            $consulta->bindValue(":item_id",$item_id);  

    }
            //executar
        if ( $consulta->execute() ) {            
            //salvar no banco
            $pdo->commit();

            $msg = "Registro inserido com sucesso!";
            sucesso( $msg, "listar/pagamento" );

        } else {
            //erro do sql
            echo $consulta->errorInfo()[2];
            exit;
            $msg = "Erro ao salvar endereco";
            mensagem( $msg );
        }
    }
