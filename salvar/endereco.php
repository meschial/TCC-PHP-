<?php 

  $usuario_id = $_SESSION["tcc"]["id"];

  if ( $_POST ) { 
foreach ($_POST as $key => $value) {
            $$key = trim ( $value );
        }


    $pdo->beginTransaction();


    if ( empty ( $id ) ) {       
     $sql = "insert into endereco 
     (id, cep, rua, complemento, bairro, cidade, numero, estado, usuario_id) 
     values
     (null, :cep, :rua, :complemento, :bairro, :cidade, :numero, :estado, :usuario_id)";

            //salvar no banco
            $consulta = $pdo->prepare( $sql );
            $consulta->bindValue(":cep",$cep);
            $consulta->bindValue(":rua",$rua);          
            $consulta->bindValue(":complemento",$complemento);
            $consulta->bindValue(":bairro",$bairro);
            $consulta->bindValue(":cidade",$cidade);
            $consulta->bindValue(":numero",$numero);
            $consulta->bindValue(":estado",$uf);
            $consulta->bindValue(":usuario_id",$usuario_id);    

    }else if(empty ( $cidade ) ) {            
            //update
            $sql = "update endereco set cep = :cep,
                rua = :rua, complemento = :complemento, bairro = :bairro,
                cidade = :cidade, numero = :numero, estado = :estado
                where id = :id limit 1";
            $consulta =  $pdo->prepare($sql);
            $consulta->bindValue(":cep",$cep);
            $consulta->bindValue(":rua",$rua);
            $consulta->bindValue(":complemento",$complemento);
            $consulta->bindValue(":bairro",$bairro);
            $consulta->bindValue(":cidade",$cidade);          
            $consulta->bindValue(":numero",$numero);
            $consulta->bindValue(":estado",$uf);
            $consulta->bindValue(":id", $id);

        } else {
            //update
            $sql = "update endereco set cep = :cep,
                rua = :rua, complemento = :complemento, bairro = :bairro,
                cidade = :cidade, numero = :numero, estado = :estado
                where id = :id limit 1";
            $consulta =  $pdo->prepare($sql);
            $consulta->bindValue(":cep",$cep);
            $consulta->bindValue(":rua",$rua);
            $consulta->bindValue(":complemento",$complemento);
            $consulta->bindValue(":bairro",$bairro);
            $consulta->bindValue(":cidade",$cidade);          
            $consulta->bindValue(":numero",$numero);
            $consulta->bindValue(":estado",$uf);
            $consulta->bindValue(":id", $id);
        }
            //executar
        if ( $consulta->execute() ) {            
            //salvar no banco
            $pdo->commit();

            $msg = "Registro inserido com sucesso!";
            sucesso( $msg, "listar/endereco" );

        } else {
            //erro do sql
            echo $consulta->errorInfo()[2];
            exit;
            $msg = "Erro ao salvar endereco";
            mensagem( $msg );
        }
    }
