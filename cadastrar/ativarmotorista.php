<?php
//verificar se o arquivo existe
  if ( file_exists ( "verificasuper.php" ) )
    include "verificasuper.php";
  else
    include "../verificasuper.php";

 $id = $cnh = $tipo_cnh = $foto = $nome = $cpf = $celular = $data = $email =  "";
  

  //$p[1] -> index.php (id do registro)
  if ( isset ( $p[2] ) ) {
    $id = (int)$p[2];
    //selecionar os dados conforme o id

    $sql = "select *, date_format(data, '%d/%m/%Y') data from motorista
            inner join usuario 
            on usuario.id  = motorista.usuario_id
            where usuario.id = $id limit 1";
    $consulta = $pdo->prepare( $sql );
    $consulta->bindParam(1,$p[2]);
    $consulta->execute();
    //recuperar os dados
    $dados = $consulta->fetch(PDO::FETCH_OBJ);

    $usuario_id          = $dados->usuario_id;    
    $nome        = $dados->nome;    
    $cpf         = $dados->cpf;
    $cnh         = $dados->cnh;
    $celular    = $dados->celular;
    $data    = $dados->data;
    $email    = $dados->email;
    $foto        = $dados->foto;
    
  }

?>
<div class="container">
    <form>
      <div class="form-row">
            
        <div class="form-group col-md-2">
          <label for="cep">Nome</label>
          <input  name="cep" type="text"  value="<?=$nome;?>" readonly class="form-control">
        </div>
        <div class="form-group col-md-6">
          <label for="cpf">CPF:</label>
          <input type="text"  value="<?=$cpf;?>" readonly class="form-control">
        </div>
        <div class="form-group col-md-2">
          <label for="cnh">CNH</label>
          <input  type="text"  value="<?=$cnh;?>" readonly class="form-control">
        </div>
     </div>       
     <div class="form-row">
        <div class="form-group col-md-10">
          <label for="celular">Celular:</label>
          <input type="text"  value="<?=$celular;?>" readonly class="form-control">
        </div>
        <div class="form-group col-md-2">
          <label for="data">Data Nascimento</label>
          <input type="text" value="<?=$data;?>" readonly class="form-control">
        </div>
     </div>
     <div class="form-row">
        <div class="form-group col-md-6">
          <label for="email">E-mail:</label>
          <input type="text" readonly value="<?=$email;?>" class="form-control">
      </div>
        <div class="form-group col-md-6">         
          <label for="foto">Foto</label>  
          <?php
            //mostrar a foto se estiver editando
            if ( !empty ( $id ) ) {
              // 12345 -> ../fotos/12345p.jpg
              //muda o nome do arquivo
              $foto = "fotos/".$foto."m.jpg";
              //mostra o arquivo dentro do img
              echo "<br><img src='$foto' width='250px'><br>";
            }
          ?>
        </div>       
    </div>
    </form>
    <form method="post" action="salvar/ativarusuario/$usuario_id">    
        <input  name="id" type="text" hidden  value="<?=$usuario_id;?>" >              
        <input type="text"   value="s" hidden  name="ativo">   
      <button type="submit" class="btn btn-primary">Ativar</button>
    </form>
  </div>
