<?php 

  $cliente_id = $_SESSION["tcc"]["id"];

  if ( $_POST ) { 
foreach ($_POST as $key => $value) {
            $$key = trim ( $value );
        }

    $data_venda = formataData( $data_venda );
    $pdo->beginTransaction();


    if ( empty ( $iditem ) ) {       
     $sql = "insert into item 
     (id, data_venda, status, rota_id, parada_id, cliente_id) 
     values
     (null, :data_venda, :status, :rota_id, :parada_id, :cliente_id)";

            //salvar no banco
            $consulta = $pdo->prepare( $sql );
            $consulta->bindValue(":data_venda",$data_venda);
            $consulta->bindValue(":status",$status);          
            $consulta->bindValue(":rota_id",$rota_id);
            $consulta->bindValue(":parada_id",$parada_id);
            $consulta->bindValue(":cliente_id",$cliente_id); 

    }else if(empty ( $status ) ) {            
            //update
            $sql = "update endereco set data_venda = :data_venda,
                status = :status
                where iditem = :iditem limit 1";
            $consulta =  $pdo->prepare($sql);
            $consulta->bindValue(":data_venda",$data_venda);
            $consulta->bindValue(":status",$status);
            $consulta->bindValue(":iditem", $iditem);

        } else {
            //update
            $sql = "update endereco set data_venda = :data_venda,
                status = :status
                where iditem = :iditem limit 1";
            $consulta =  $pdo->prepare($sql);
            $consulta->bindValue(":data_venda",$data_venda);
            $consulta->bindValue(":status",$status);
            $consulta->bindValue(":iditem", $iditem);
        }
            //executar
        if ( $consulta->execute() ) {            
            //salvar no banco
            $pdo->commit();

            $msg = "Registro inserido com sucesso!";
            sucesso( $msg, "listar/envios" );

        } else {
            //erro do sql
            echo $consulta->errorInfo()[2];
            exit;
            $msg = "Erro ao salvar endereco";
            mensagem( $msg );
        }
    }
