<?php
  if  ( !isset ( $_SESSION["tcc"]["id"] ) ) {
    echo "<script>location.href='paginas/home'</script>";
  }

  
 $id = $nome = $cpf = $rg = $data = $email = $celular = $celular2  = $apelido = $tipo = "";
  //$p[1] -> index.php (id do registro)
  if ( isset ( $p[2] ) ) {
    //selecionar os dados conforme o id
    $sql = "select * from usuario where id = ? limit 1";
    $consulta = $pdo->prepare( $sql );
    $consulta->bindParam(1,$p[2]);
    $consulta->execute();
    //recuperar os dados
    $dados = $consulta->fetch(PDO::FETCH_OBJ);

    $id       = $dados->id;    
    $nome     = $dados->nome;
    $cpf      = $dados->cpf;
    $rg      = $dados->rg;
    $data     = $dados->data;
    $email      = $dados->email; 
    $celular     = $dados->celular;
    $celular2    = $dados->celular2;
    $tipo     = $dados->tipo;    
    $apelido     = $dados->apelido;
  }
?>
<div class="container">
    <form name="cadastro" method="post" action="salvar/usuario">

      <div class="form-row">
          <div class="form-group col-md-1">
           <label for="id">ID</label>
           <input type="text" class="form-control" name="id" value="<?=$id;?>" readonly placeholder="ID">
          </div>
          <div class="form-group col-md-9">
           <label for="nome">Nome</label>
           <input type="text" class="form-control" name="nome" value="<?=$nome;?>" placeholder="Digite seu nome completo">
          </div>
          <div class="form-group col-md-2">
            <label for="data">Data</label>
            <input type="text" class="form-control" name="data" value="<?=$data;?>" placeholder="Data Nascimento"> 
          </div> 
      </div>

      <div class="form-row">
          <div class="form-group col-md-3">
           <label for="cpf">CPF</label>
           <input type="text" class="form-control" name="cpf" value="<?=$cpf;?>" data-Mask="999.999.999-99" placeholder="Digite seu cpf">
          </div>
          <div class="form-group col-md-3">
            <label for="rg">RG</label>
            <input type="text" class="form-control" name="rg" value="<?=$rg;?>" placeholder="Digite seu rg">
          </div>
          <div class="form-group col-md-6">
            <label for="email">E-mail</label>
            <input type="text" class="form-control" name="email" value="<?=$email;?>" placeholder="digite seu E-mail">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-4">
           <label for="celular">Celular</label>
          <input type="text" class="form-control" name="celular" value="<?=$celular;?>" placeholder="Número do Celular">
          </div>
          <div class="form-group col-md-4">
            <label for="celular2">Celular2</label>
            <input type="text" class="form-control" name="celular2" value="<?=$celular2;?>" placeholder="Número do Celular II">
          </div>
          <div class="form-group col-md-4">
            <label  for="apelido">Apelido</label>
            <input type="text" class="form-control" name="apelido" value="<?=$apelido;?>" placeholder="Como gostaria de ser chamado?">
          </div>
        </div>
                         
          <label class="sr-only" for="tipo">Ativo</label>
          <input type="text" hidden  value="<?=$tipo;?>" readonly name="tipo"> 

                                         

          <button type="submit" class="btn btn-outline-success mb-2 mr-sm-2">Alterar Dados</button>
    </form>
 </div>
 