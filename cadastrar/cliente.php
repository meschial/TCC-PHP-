<?php
  if ( file_exists ( "verificacliente.php" ) )
    include "verificacliente.php";
  else
    include "../verificacliente.php";

$idd = $_SESSION["tcc"]["id"];
   $sql = "select * from cliente where usuario_id = $idd";
          $consulta = $pdo->prepare($sql);
          $consulta->bindParam(1,$p[2]);
          $consulta->execute();
          $dados = $consulta->fetch(PDO::FETCH_OBJ);
          if (!empty($dados->usuario_id) and ($p[2]<>$dados->id)  ) {
           
           $msg = "Ja tem dados";
            mensagem( $msg );          
        }
       
 $id = $foto  = "";
  //$p[1] -> index.php (id do registro)
if ( isset ( $p[2] ) ) {
    //selecionar os dados conforme o id
    $sql = "select * from cliente where id = ? limit 1";
    $consulta = $pdo->prepare( $sql );
    $consulta->bindParam(1,$p[2]);
    $consulta->execute();
    //recuperar os dados
    $dados = $consulta->fetch(PDO::FETCH_OBJ);

    $id      = $dados->id;   
    
    $foto    = $dados->foto;
  }
  
?>
<div class="container">
    <form name="cadastro" method="post" action="salvar/cliente"  enctype="multipart/form-data">
      
      <div class="form-row">
        <div class="form-group col-md-2">
         <label for="id">Id</label>
         <input type="text" class="form-control" name="id" value="<?=$id;?>" readonly placeholder="ID">
        </div>
         <?php
        $r = " required data-parsley-required-message=\"Selecione um arquivo\" ";

        //se o id nao esta vazio esta editando
        if ( !empty ( $id ) ) {
          //zerar o r para o campo não ser requerido
          $r = "";

          //montar um input com o numero da foto
          echo "<input type='hidden' name='foto' value='$foto'>";
        }
      ?>
        <div class="form-group col-md-6">
         <label for="foto">Foto da Capa (JPG):</label>
         <input type="file" name="foto" class="form-control" <?=$r;?> accept=".jpg">
        </div>
      </div>

      

      <?php
        //mostrar a foto se estiver editando
        if ( !empty ( $id ) ) {
          // 12345 -> ../fotos/12345p.jpg
          //muda o nome do arquivo
          $foto = "fotos/".$foto."g.jpg";
          //mostra o arquivo dentro do img
          echo "<br><img src='$foto' width='500px'><br>";
        }
      ?>

      </br>

          <button type="submit" class="btn btn-outline-success mb-2 mr-sm-2">Salvar</button>
    </form>
 </div>
 