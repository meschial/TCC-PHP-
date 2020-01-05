<?php
     if  ( !isset ( $_SESSION["tcc"]["id"] ) ) {
    echo "<script>location.href='paginas/home'</script>";
  }
  //passar vazio nos campos
  $id = $cep = $rua = $numero = $bairro = $complemento = $cidade = $uf = "";

  //$p[1] -> index.php (id do registro)
  if ( isset ( $p[2] ) ) {
    //selecionar os dados conforme o id
    $sql = "select * from endereco where id = ? limit 1";
    $consulta = $pdo->prepare( $sql );
    $consulta->bindParam(1,$p[2]);
    $consulta->execute();
    //recuperar os dados
    $dados        = $consulta->fetch(PDO::FETCH_OBJ);
    $id           = $dados->id;    
    $cep          = $dados->cep;
    $rua          = $dados->rua;
    $numero       = $dados->numero;
    $bairro       = $dados->bairro;
    $complemento  = $dados->complemento;    
    $cidade       = $dados->cidade;
    $uf           = $dados->estado;    
  }
?>    
    <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <!-- Adicionando Javascript -->
    <script type="text/javascript" >

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
    </script>   

    <div class="container">
	  <form method="post" action="salvar/endereco">
	  	<div class="form-row">
            <div class="form-group col-md-2">
              <label for="id">ID</label>
              <input  name="id" type="text" id="id" value="<?=$id;?>" readonly class="form-control">
            </div>
	  		<div class="form-group col-md-2">
		      <label for="cep">CEP</label>
		      <input  name="cep" type="text" id="cep" value="<?=$cep;?>" required data-Mask="99999-999" class="form-control">
		    </div>
		    <div class="form-group col-md-6">
		      <label for="rua">Rua:</label>
		      <input name="rua" type="text" id="rua" value="<?=$rua;?>" required class="form-control">
		    </div>
		    <div class="form-group col-md-2">
		      <label for="numero">Número</label>
		      <input  name="numero" type="text" id="numero" value="<?=$numero;?>" required class="form-control">
		    </div>
		 </div>		    
		 <div class="form-row">
		    <div class="form-group col-md-10">
		      <label for="bairro">Bairo:</label>
		      <input  name="bairro" type="text" id="bairro" value="<?=$bairro;?>" required class="form-control">
		    </div>
		    <div class="form-group col-md-2">
		      <label for="complemento">Complemento</label>
		      <input  name="complemento" type="text" id="complemento" value="<?=$complemento;?>" required class="form-control">
		    </div>
		 </div>
		 <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="cidade">Cidade:</label>
		      <input name="cidade" type="text" id="cidade" readonly value="<?=$cidade;?>" class="form-control">
		 	</div>
		  	<div class="form-group col-md-6">
		      <label for="uf">Estado:</label>
		      <input name="uf" type="text" id="uf" readonly value="<?=$uf;?>" class="form-control">
		    </div>
		</div>	 
		  <button type="submit" class="btn btn-primary">Cadastrar</button>
	  </form>
	</div>