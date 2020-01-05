<?php
  if ( file_exists ( "verificasuper.php" ) )
    include "verificasuper.php";
  else
    include "../verificasuper.php";

  //passar vazio nos campos
  $id = $descricao = $peso = $altura = $comprimento = $largura = "";

  //$p[1] -> index.php (id do registro)
  if ( isset ( $p[2] ) ) {
    //selecionar os dados conforme o id
    $sql = "select * from tamanho where id = ? limit 1";
    $consulta = $pdo->prepare( $sql );
    $consulta->bindParam(1,$p[2]);
    $consulta->execute();
    //recuperar os dados
    $dados        = $consulta->fetch(PDO::FETCH_OBJ);
    $id           = $dados->id;    
    $descricao    = $dados->descricao;
    $peso         = $dados->peso;
    $altura       = $dados->altura;
    $comprimento  = $dados->comprimento;  
    $largura      = $dados->largura;  
  }
?>
<div class="container">
	  <form method="post" action="salvar/tamanho">
	  	<div class="form-row">
            <div class="form-group col-md-2">
              <label for="id">ID</label>
              <input  name="id" type="text" value="<?=$id;?>" readonly class="form-control">
            </div>
	  		<div class="form-group col-md-12">
		      <label for="descricao">Descrição:</label>
		      <input  name="descricao" type="text" value="<?=$descricao;?>" required data-Mask="(LARGURA-999/CM   +   ALTURA-999/CM   +   COMPRIMENTO-999/CM   +   PESO-9.999/GRAMAS" class="form-control">
		    </div>
		    <div class="form-group col-md-2">
		      <label for="peso">Peso:</label>
		      <input name="peso" type="text" value="<?=$peso;?>" required class="form-control">
		    </div>
		    <div class="form-group col-md-2">
		      <label for="altura">Altura:</label>
		      <input  name="altura" type="text" value="<?=$altura;?>" required class="form-control">
		    </div>
		    <div class="form-group col-md-2">
		      <label for="comprimento">Comprimento:</label>
		      <input  name="comprimento" type="text" value="<?=$comprimento;?>" required class="form-control">
		    </div>
		    <div class="form-group col-md-2">
		      <label for="largura">Largura:</label>
		      <input  name="largura" type="text" value="<?=$largura;?>" required class="form-control">
		    </div>
		 </div>
		 	 
		  <button type="submit" class="btn btn-primary">Cadastrar</button>
	  </form>
	</div>