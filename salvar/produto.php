<?php 

  $cliente_id = $_SESSION["tcc"]["id"];

  if ( $_POST ) { 
foreach ($_POST as $key => $value) {
            $$key = trim ( $value );
        }

    $pdo->beginTransaction();

    if ( empty ( $id ) ) {       
     $sql = "insert into produto 
     (id, nome, peso, altura, comprimento, largura, item_id, quantidade, cliente_id) 
     values
     (null, :nome, :peso, :altura, :comprimento, :largura, :item_id, :quantidade, :cliente_id)";

            //salvar no banco
            $consulta = $pdo->prepare( $sql );
            $consulta->bindValue(":nome",$nome);
            $consulta->bindValue(":peso",$peso);          
            $consulta->bindValue(":altura",$altura);
            $consulta->bindValue(":comprimento",$comprimento);
            $consulta->bindValue(":largura",$largura);
            $consulta->bindValue(":item_id",$item_id);
            $consulta->bindValue(":quantidade",$quantidade);
            $consulta->bindValue(":cliente_id",$cliente_id);    

    }else if(empty ( $largura ) ) {            
            //update
            $sql = "update produto set nome = :nome,
                peso = :peso, altura = :altura, comprimento = :comprimento
                where idproduto = :idproduto limit 1";
            $consulta =  $pdo->prepare($sql);
            $consulta->bindValue(":nome",$nome);
            $consulta->bindValue(":peso",$peso);
            $consulta->bindValue(":altura",$altura);
            $consulta->bindValue(":comprimento",$comprimento);
            $consulta->bindValue(":largura",$largura);
            $consulta->bindValue(":idproduto", $idproduto);

        } else {
            //update
            $sql = "update produto set nome = :nome,
                peso = :peso, altura = :altura, comprimento = :comprimento, largura = :largura              
                where idproduto = :idproduto limit 1";
            $consulta =  $pdo->prepare($sql);
            $consulta->bindValue(":nome",$nome);
            $consulta->bindValue(":peso",$peso);
            $consulta->bindValue(":altura",$altura);
            $consulta->bindValue(":comprimento",$comprimento);
            $consulta->bindValue(":largura",$largura);
            $consulta->bindValue(":idproduto", $idproduto);
        }
            //executar
        if ( $consulta->execute() ) {            
            //salvar no banco
            $pdo->commit();

            $msg = "Registro inserido com sucesso!";
            sucesso( $msg, "listar/produto" );

        } else {
            //erro do sql
            echo $consulta->errorInfo()[2];
            exit;
            $msg = "Erro ao salvar tamanho";
            mensagem( $msg );
        }
    }
