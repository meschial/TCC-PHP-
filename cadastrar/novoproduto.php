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
              <input  name="id" type="text" readonly class="form-control">
            </div>
	  		<div class="form-group col-md-9">
		      <label for="nome">Nome</label>
		      <input  name="nome" type="text" required class="form-control">
		    </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-3">
          <label for="peso">Peso</label>
          <input  name="peso" type="text" required class="form-control">
        </div>
        <div class="form-group col-md-3">
          <label for="altura">Altura</label>
          <input  name="altura" type="text" required class="form-control">
        </div>	    
			  <div class="form-group col-md-3">
          <label for="comprimento">Comprimento</label>
          <input  name="comprimento" type="text"  required class="form-control">
        </div>
        <div class="form-group col-md-3">
          <label for="largura">Largura</label>
          <input  name="largura" type="text" required class="form-control">
        </div> 
        <div class="form-group col-md-3">
          <label for="largura">Quantidade</label>
          <input  name="quantidade" type="text" required class="form-control">
        </div>  
         <div class="form-group col-md-3">
          <label for="clieten">ID Cliente</label>
          <input  name="cliente_id" type="text"  value="<?=$cliente_id;?>" required class="form-control">
        </div>  
    </div> 
		  <button type="submit" class="btn btn-primary">Cadastrar</button>
	  </form>
	</div>