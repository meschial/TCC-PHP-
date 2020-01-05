<?php
//verificar se o arquivo existe
    if ( file_exists ( "verificamotorista.php" ) )
        include "verificamotorista.php";
    else
        include "../verificamotorista.php";

    $ativo = $_SESSION["tcc"]["ativo"];

    if ("n"==$ativo) {
        echo "<script>location.href='paginas/home'</script>";
    }
//passar vazio nos campos
  $id  = $cep = $valo = "";

  //$p[1] -> index.php (id do registro)
  if ( isset ( $p[2] ) ) {
    //selecionar os dados conforme o id
    $sql = "select * from rota where id = ? limit 1";
    $consulta = $pdo->prepare( $sql );
    $consulta->bindParam(1,$p[2]);
    $consulta->execute();
    //recuperar os dados
    $dados        = $consulta->fetch(PDO::FETCH_OBJ);
    $rota_id           = $dados->id;    
        
  }
?>    

<form class="container" name="novasrotas" method="post" action="salvar/novasrotas">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label class="sr-only" for="id">Id</label>
                        <input type="text" class="form-control mb-2 mr-sm-2 col-sm-2" name="idparada"  readonly placeholder="ID">
                      </div>
                  
                      <div class="form-group col-md-6">
                        <label class="sr-only" for="id">Id</label>
                        <input type="text" class="form-control mb-2 mr-sm-2 col-sm-2" name="rota_id" value="<?=$rota_id;?>" readonly placeholder="ID">
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="cep">Cep:</label></br>
                        <input type="text" class="form-control" name="cep" id="cep" required data-mask="99999-999" placeholder="Digite novo cep">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="valor">Valor R$: </label>
                        <input type="text" name="valo"  class="form-control" required  value="<?=$valo;?>">
                      </div>
                    </div> 
                      <button type="submit" class="btn btn-outline-success mb-2 mr-sm-2">Cadastrar</button>
                    </form>

                     <script type="text/javascript">
  $(document).ready(function(){
    

    //aplica a mascara de valor no campo
    $("#valor").maskMoney({
      thousands: ".",
      decimal: ","
    });

   
  })
</script>
