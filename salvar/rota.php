<?php 
                    

  $motorista_id = $_SESSION["tcc"]["id"];


  if ( $_POST ) { 
foreach ($_POST as $key => $value) {
            $$key = trim ( $value );
        }
        //datas
        $valor = formataValor( $valor );
        $data_inicio = formataData( $data_inicio );

    $pdo->beginTransaction();


    if ( empty ( $id ) ) {       
     $sql = "insert into rota 
     (id, quantidade, data_inicio, cep_inicio, cep_fim, valor, cidade_inicio, cidade_fim, tamanho_id, motorista_id) 
     values
     (null, :quantidade, :data_inicio, :cep_inicio, :cep_fim, :valor, :cidade_inicio, :cidade_fim, :tamanho, :motorista_id)";

            //salvar no banco
            $consulta = $pdo->prepare( $sql );
            $consulta->bindValue(":quantidade",$quantidade);
            $consulta->bindValue(":data_inicio",$data_inicio);          
            $consulta->bindValue(":cep_inicio",$cep_inicio);
            $consulta->bindValue(":cep_fim",$cep_fim);          
            $consulta->bindValue(":valor",$valor);          
            $consulta->bindValue(":cidade_inicio",$cidade_inicio);          
            $consulta->bindValue(":cidade_fim",$cidade_fim);          
            $consulta->bindValue(":tamanho",$tamanho);          
            $consulta->bindValue(":motorista_id",$motorista_id);    

    }else if(empty ( $quantidade ) ) {            
            //update
            $sql = "update rota set quantidade = :quantidade,
                data_inicio = :data_inicio, cep_inicio = :cep_inicio, cep_fim = :cep_fim, valor = :valor, tamanho_id = :tamanho
                where id = :id limit 1";
            $consulta =  $pdo->prepare($sql);
            $consulta->bindValue(":quantidade",$quantidade);
            $consulta->bindValue(":data_inicio",$data_inicio);
            $consulta->bindValue(":cep_inicio",$cep_inicio);
            $consulta->bindValue(":cep_fim",$cep_fim);            
            $consulta->bindValue(":valor",$valor);            
            $consulta->bindValue(":tamanho",$tamanho);            
            $consulta->bindValue(":id", $id);

        } else {
            //update
            $sql = "update rota set quantidade = :quantidade,
                data_inicio = :data_inicio, cep_inicio = :cep_inicio, cep_fim = :cep_fim, valor = :valor, tamanho_id = :tamanho
                where id = :id limit 1";
            $consulta =  $pdo->prepare($sql);
            $consulta->bindValue(":quantidade",$quantidade);
            $consulta->bindValue(":data_inicio",$data_inicio);
            $consulta->bindValue(":cep_inicio",$cep_inicio);
            $consulta->bindValue(":cep_fim",$cep_fim);
            $consulta->bindValue(":valor",$valor);
            $consulta->bindValue(":tamanho",$tamanho);
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
            $msg = "Erro ao salvar endereco";
            mensagem( $msg );
        }
    }
