<?php 

  $usuario_id = $_SESSION["tcc"]["id"];

    //iniciar uma transação
    $pdo->beginTransaction();

    //se os dados vieram por POST
    if ( $_POST ) {
        //recuperar as variaveis
        foreach ($_POST as $key => $value) {
            //echo "<p>$key $value</p>";
            //$key - nome do campo
            //$value - valor do campo (digitado)
            if ( isset ( $_POST[$key] ) ) {
                $$key = trim ( $value );
            } 
        }       
        

        //se o id for vazio insere - se não update!
        if ( empty ( $id ) ) {

            //adicionar um nome de foto de capa
            $foto = time();

            //insert
            $sql = "insert into motorista 
            (id, cnh, tipo_cnh, foto, usuario_id)
            values 
            (NULL, :cnh, :tipo_cnh, :foto, :usuario_id)";

            $consulta = $pdo->prepare( $sql );
            $consulta->bindValue(":cnh",$cnh);
            $consulta->bindValue(":tipo_cnh",$tipo_cnh);
            $consulta->bindValue(":foto",$foto);
         
            $consulta->bindValue(":usuario_id",$usuario_id);
            
        } else {
            //update
            $sql = "update motorista set cnh = :cnh,
                tipo_cnh = :tipo_cnh, foto = :foto, 
                usuario_id = :usuario_id
                where id = :id limit 1";
            $consulta =  $pdo->prepare($sql);
            $consulta->bindValue(":cnh",$cnh);
            $consulta->bindValue(":tipo_cnh",$tipo_cnh);
            $consulta->bindValue(":foto",$foto);
            
            $consulta->bindValue(":usuario_id",$usuario_id);            
            $consulta->bindValue(":id", $id);

        }

        //executar
        if ( $consulta->execute() ) {            

            //se a capa não estiver vazio - copiar
            if ( !empty ( $_FILES["foto"]["name"] ) ) {
                echo $_FILES["foto"]["name"];
                //copiar o arquivo para a pasta

                if ( !copy( $_FILES["foto"]["tmp_name"], 
                    "fotos/".$_FILES["foto"]["name"] )) {

                    $msg = "Erro ao copiar foto";
                    mensagem( $msg );
                }

                //echo $capa;

                $pastaFotos = "fotos/";
                $imagem = $_FILES["foto"]["name"];

                redimensionarImagem($pastaFotos,$imagem,$foto);
            }
            
            //salvar no banco
            $pdo->commit();

            $msg = "Registro inserido com sucesso!";
            sucesso( $msg, "listar/motorista" );

        } else {
            //erro do sql
            echo $consulta->errorInfo()[2];
            exit;
            $msg = "Erro ao salvar motorista";
            mensagem( $msg );
        }


    } else {
        //se não foi veio do formulario
        $msg = "Requisição inválida";
        mensagem( $msg );
    }

  