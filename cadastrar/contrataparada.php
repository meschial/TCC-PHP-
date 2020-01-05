<?php
  if ( file_exists ( "verificacliente.php" ) )
    include "verificacliente.php";
  else
    include "../verificacliente.php";

$idd = $_SESSION["tcc"]["id"];
  
 $id  = $idparada = $valor = $cep_inicio = $cep_fim = "";
  //$p[1] -> index.php (id do registro)
  if ( isset ( $p[2] ) ) {
    $idparada = (int)$p[2];
    
    //selecionar os dados conforme o id

    $sql = "select rota.id, rota.cep_fim, parada.cep, parada.valo from rota
            inner join parada on rota.id = parada.rota_id                 
            where parada.idparada = $idparada limit 1";
    $consulta = $pdo->prepare( $sql );
    $consulta->bindParam(1,$p[2]);
    $consulta->execute();
    //recuperar os dados
    $dados = $consulta->fetch(PDO::FETCH_OBJ);
    $id           = $dados->id;   
    $valor        = $dados->valo;   
    $cep_inicio   = $dados->cep;   
    $cep_fim      = $dados->cep_fim;   
    
  }
 
?>
<div class="container">
   <form method="post" action="salvar/ativarusuario">  
      <div class="form-row">
            
        <div class="form-group col-md-1">
          <label for="cep">ID Rota:</label>
          <input  name="cep" type="text"  value="<?=$id;?>" readonly class="form-control">
        </div>
        <div class="form-group col-md-1">
          <label for="cep">ID Parada:</label>
          <input  name="cep" type="text"  value="<?=$idparada;?>" readonly class="form-control">
        </div>
        <div class="form-group col-md-2">
          <label for="cpf">IDD cliente:</label>
          <input type="text"  value="<?=$idd;?>" readonly class="form-control">
        </div>
        <div class="form-group col-md-2">
          <label for="valor">Valor:</label>
          <input type="text"  value="<?=$valor;?>" readonly class="form-control">
        </div>        
     </div>       
     <div class="form-row">
        <div class="form-group col-md-2">
          <label for="cep1">CEP Inicio</label>
          <input type="text" value="<?=$cep_inicio;?>" readonly class="form-control">
        </div>
        <div class="form-group col-md-2">
          <label for="cep2">CEP Destino</label>
          <input type="text" value="<?=$cep_fim;?>" readonly class="form-control">
        </div>
     </div>

        <div class="form-row">        
        
         <div class="form-group col-md-2">
          <label for="tamanho">Produto:</label>
          <select name="produto" id="produto" 
          class="form-control" required data-parsley-required-message="Selecione uma opção">
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