<?php
//verificar se o arquivo existe
  if ( file_exists ( "verificamotorista.php" ) )
    include "verificamotorista.php";
  else
    include "../verificamotorista.php";
      
 $id = $cnh = $tipo_cnh = $foto  = "";
  //$p[1] -> index.php (id do registro)
if ( isset ( $p[2] ) ) {
    //selecionar os dados conforme o id
    $sql = "select * from motorista where id = ? limit 1";
    $consulta = $pdo->prepare( $sql );
    $consulta->bindParam(1,$p[2]);
    $consulta->execute();
    //recuperar os dados
    $dados = $consulta->fetch(PDO::FETCH_OBJ);

    $id      = $dados->id;    
    $cnh     = $dados->cnh;
    $tipo_cnh    = $dados->tipo_cnh;
    $foto    = $dados->foto;
  }
  
?>
<div class="container">
    <form name="cadastro" method="post" action="salvar/motorista"  enctype="multipart/form-data">
      <div class="form-row">
        <div class="form-group col-md-2">
           <label for="id">Id</label>
         <input type="text" class="form-control" name="id" value="<?=$id;?>" readonly placeholder="ID">
        </div>
        <div class="form-group col-md-5">
           <label for="cnh">Número da CNH:</label>
           <input type="text" class="form-control" name="cnh" value="<?=$cnh;?>" required data-mask="999.999.999-99" placeholder="Digite o número da sua CNH:">
        </div>
        <div class="form-group col-md-4">
           <label for="inputEstado">Tipo Carteira</label>
           <select name="tipo_cnh" class="form-control" required>
            <option value="">Escolher</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="AB">A/B</option>
            <option value="C">C</option>            
           </select>
        </div>
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
    <div class="form-row">
        <div class="form-group col-md-5">
           <label for="foto">Foto da Capa (JPG):</label>
           <input type="file" name="foto" class="form-control" <?=$r;?> accept=".jpg">
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

                                         
 </div>
          <button type="submit" class="btn btn-outline-success mb-2 mr-sm-2">Salvar</button>
    </form>
 </div>
 