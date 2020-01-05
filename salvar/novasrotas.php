<?php 

  

  if ( $_POST ) { 
foreach ($_POST as $key => $value) {
            $$key = trim ( $value );
        }

    $pdo->beginTransaction();


    if ( empty ( $idparada ) ) {       
     $sql = "insert into parada 
     (idparada, cep, valo, rota_id) 
     values
     (null, :cep, :valo, :rota_id)";

            //salvar no banco
            $consulta = $pdo->prepare( $sql );
            $consulta->bindValue(":cep",$cep);
            $consulta->bindValue(":valo",$valo);          
            $consulta->bindValue(":rota_id",$rota_id);
               

    }else if(empty ( $cep ) ) {            
            //update
            $sql = "update rota set cep = :cep,
                valo = :valo, partida = :partida, destino = :destino
                where idparada = :idparada limit 1";
            $consulta =  $pdo->prepare($sql);
            $consulta->bindValue(":cep",$cep);
            $consulta->bindValue(":valo",$valo);          
            $consulta->bindValue(":idparada", $idparada);

        } else {
            //update
            $sql = "update rota set cep = :cep,
                valo = :valo
                where idparada = :idparada limit 1";
            $consulta =  $pdo->prepare($sql);
            $consulta->bindValue(":cep",$cep);
            $consulta->bindValue(":valo",$valo);
            $consulta->bindValue(":idparada", $idparada);
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
