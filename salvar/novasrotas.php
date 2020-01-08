<?php 

  

  if ( $_POST ) { 
foreach ($_POST as $key => $value) {
            $$key = trim ( $value );
        }

    $pdo->beginTransaction();


    if ( empty ( $id ) ) {       
     $sql = "insert into parada 
     (id, cep, valor, rota_id) 
     values
     (null, :cep, :valor, :rota_id)";

            //salvar no banco
            $consulta = $pdo->prepare( $sql );
            $consulta->bindValue(":cep",$cep);
            $consulta->bindValue(":valor",$valor);          
            $consulta->bindValue(":rota_id",$rota_id);
               

    }else if(empty ( $cep ) ) {            
            //update
            $sql = "update rota set cep = :cep,
                valor = :valor, partida = :partida, destino = :destino
                where id = :id limit 1";
            $consulta =  $pdo->prepare($sql);
            $consulta->bindValue(":cep",$cep);
            $consulta->bindValue(":valor",$valor);          
            $consulta->bindValue(":id", $id);

        } else {
            //update
            $sql = "update rota set cep = :cep,
                valor = :valor
                where id = :id limit 1";
            $consulta =  $pdo->prepare($sql);
            $consulta->bindValue(":cep",$cep);
            $consulta->bindValue(":valor",$valor);
            $consulta->bindValue(":id", $id);
        }
            //executar
        if ( $consulta->execute() ) {            
            //salvar no banco
            $pdo->commit();

            $msg = "Registro inserido com sucesso!";
            sucesso( $msg, "listar/rotasmotorista" );

        } else {
            //erro do sql
            echo $consulta->errorInfo()[2];
            exit;
            $msg = "Erro ao salvar rotas";
            mensagem( $msg );
        }
    }
