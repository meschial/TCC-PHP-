<?php
  if ( file_exists ( "verificacliente.php" ) )
    include "verificacliente.php";
  else
    include "../verificacliente.php";

$idd = $_SESSION["tcc"]["id"];
  
 $id  = $idparada = $valor = $cep_inicio = $cep_fim = "";
  //$p[1] -> index.php (id do registro)
  if ( isset ( $p[2] ) ) {
    $idrota = (int)$p[2];    
    //selecionar os dados conforme o id

    $sql = "select * from item                 
            where cliente_id = $idd and status = '1' limit 1";
    $consulta = $pdo->prepare( $sql );
    $consulta->bindParam(1,$p[2]);
    $consulta->execute();
    //recuperar os dados
    $dados = $consulta->fetch(PDO::FETCH_OBJ);
    $id           = $dados->iditem;   
    $status        = $dados->status;   
    $data_venda   = $dados->data_venda;
    
  }
  
?>
<div class="container">
   <form method="post" action="salvar/vendaitem">  
      <div class="form-row">
            
               
        <div class="form-group col-md-2">
          <label for="cliente_id">IDD cliente:</label>
          <input type="text"  value="<?=$idd;?>" readonly class="form-control">
        </div>
        <div class="form-group col-md-2">
          <label for="status">Status:</label>
          <input type="text"  value="<?=$status;?>" readonly class="form-control">
        </div>        
     </div>       
     <div class="form-row">
        <div class="form-group col-md-2">
          <label for="data">Data</label>
          <input type="text" value="<?=$data_venda;?>" readonly class="form-control">
        </div>
        
        <div class="form-group col-md-2">
          <label for="data">Data Envio:</label>
          <input type="text" name="data_venda" data-mask="99/99/9999" required class="form-control">
        </div>        
     </div>

        <div class="form-row">        
        
         <div class="form-group col-md-2">
          <label for="tamanho">Produto:</label>
          <select id="produto" 
          class="form-control">
            <option value="">Selecione</option>
            <?php
              $sql = "select nome from produto where cliente_id = $idd";
                      $consulta = $pdo->prepare($sql);
                      $consulta->execute();

                      while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
                        //recuperar as variaveis
                        $id = $dados->id;
                        $nome = $dados->nome;
                        echo "<option value='$id'>$nome</option>";
                  }
            ?>
          </select>
        </div> 
      </div> 


      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>