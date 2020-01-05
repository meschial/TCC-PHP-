<?php
  if ( file_exists ( "verificacliente.php" ) )
    include "verificacliente.php";
  else
    include "../verificacliente.php";

  $cliente_id = $_SESSION["tcc"]["id"];

  
 $id = $nome = $peso = $altura = $comprimento = $largura = $quantidade = $item_id = "";
  //$p[1] -> index.php (id do registro)
  if ( isset ( $p[2] ) ) {
    $item_id = (int)$p[2];
    //selecionar os dados conforme o id

    $sql = "select * produto where id = $item_id limit 1 ";
    $consulta = $pdo->prepare( $sql );
    $consulta->bindParam(1,$p[2]);
    $consulta->execute();
    //recuperar os dados
    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {

    $idp         = $dados->id;    
    $nome        = $dados->nome; 
    $peso        = $dados->peso; 
    $altura      = $dados->altura; 
    $comprimento = $dados->comprimento; 
    $largura     = $dados->largura; 
    $quantidade  = $dados->quantidade; 
    $item_id     = $dados->item_id;
    $cliente_id  = $dados->cliente_id;  }
    

     
    
  }
?>
    <div class="container">
	  <form method="post" action="salvar/produto">
	  	<div class="form-row">
            <div class="form-group col-md-3">
              <label for="item_id">ID Item</label>
              <input  name="item_id" type="text"  value="<?=$item_id;?>" readonly class="form-control">
            </div>
            <div class="form-group col-md-3">
              <label for="id">ID Produto</label>
              <input  name="id" type="text"  value="<?=$id;?>" readonly class="form-control">
            </div>
	  		<div class="form-group col-md-9">
		      <label for="nome">Nome</label>
		      <input  name="nome" type="text"  value="<?=$nome;?>" required class="form-control">
		    </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-3">
          <label for="peso">Peso</label>
          <input  name="peso" type="text"  value="<?=$peso;?>" required class="form-control">
        </div>
        <div class="form-group col-md-3">
          <label for="altura">Altura</label>
          <input  name="altura" type="text"  value="<?=$altura;?>" required class="form-control">
        </div>	    
			  <div class="form-group col-md-3">
          <label for="comprimento">Comprimento</label>
          <input  name="comprimento" type="text"  value="<?=$comprimento;?>" required class="form-control">
        </div>
        <div class="form-group col-md-3">
          <label for="largura">Largura</label>
          <input  name="largura" type="text"  value="<?=$largura;?>" required class="form-control">
        </div> 
        <div class="form-group col-md-3">
          <label for="largura">Quantidade</label>
          <input  name="quantidade" type="text"  value="<?=$quantidade;?>" required class="form-control">
        </div>  
         <div class="form-group col-md-3">
          <label for="clieten">ID Cliente</label>
          <input  name="cliente_id" type="text"  value="<?=$cliente_id;?>" required class="form-control">
        </div>  
    </div> 
		  <button type="submit" class="btn btn-primary">Cadastrar</button>
	  </form>
	</div>