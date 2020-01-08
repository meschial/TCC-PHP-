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

    $sql = "select parada.valor, parada.cep, rota.cep_fim, rota.id from parada
    inner join rota on parada.rota_id = rota.id
    where parada.id = $idparada";
    $consulta = $pdo->prepare( $sql );
    $consulta->bindParam(1,$p[2]);
    $consulta->execute();
    //recuperar os dados
    $dados = $consulta->fetch(PDO::FETCH_OBJ);
    $id           = $dados->id;   
    $valor        = $dados->valor;   
    $cep_inicio   = $dados->cep;   
    $cep_fim      = $dados->cep_fim;   
    
  }
 
?>
<div class="container">
   <form method="post" action="salvar/vendaitem">  
      <div class="form-row">
            
        <div class="form-group col-md-1">
          <label for="rota_id">ID Rota:</label>
          <input  name="rota_id" type="text"  value="<?=$id;?>" readonly class="form-control">
        </div>
        <div class="form-group col-md-1">
          <label for="parada_id">ID Parada:</label>
          <input  name="parada_id" type="text"  value="<?=$idparada;?>" readonly class="form-control">
        </div>
        <div class="form-group col-md-2">
          <label for="cliente_id">IDD cliente:</label>
          <input type="text" name="cliente_id"  value="<?=$idd;?>" readonly class="form-control">
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

       <div class="form-group col-md-2">
          <label for="data">Data Envio:</label>
          <input type="text" name="data_venda" data-Mask="99/99/9999"  required class="form-control">
        </div>
        <div class="form-group col-md-2">
          <label for="tamanho">Status:</label>
          <select name="status" class="form-control" required data-parsley-required-message="Selecione uma opção">
            <option value="">Selecione</option>
            <option value="1">Aberto</option>
            <option value="2">Cancelado</option>
            <option value="3">Pago</option>
            <option value="4">Entregue</option>            
          </select>
        </div>


      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>