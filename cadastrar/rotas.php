<?php
    if ( file_exists ( "verificamotorista.php" ) )
        include "verificamotorista.php";
    else
        include "../verificamotorista.php";

    $ativo = $_SESSION["tcc"]["ativo"];

    if ("n"==$ativo) {
        echo "<script>location.href='paginas/home'</script>";
    }
    
 $id = $quantidade = $data_inicio = $cep_inicio = $cep_fim = $valor = "";
  //$p[1] -> index.php (id do registro)
  if ( isset ( $p[2] ) ) {
    //selecionar os dados conforme o id
    $sql = "select *, date_format(data_inicio, '%d/%m/%Y') data_inicio from rota where id = ? limit 1";
    $consulta = $pdo->prepare( $sql );
    $consulta->bindParam(1,$p[2]);
    $consulta->execute();
    //recuperar os dados
    $dados = $consulta->fetch(PDO::FETCH_OBJ);

    $id       = $dados->id;    
    $quantidade     = $dados->quantidade;
    $data_inicio      = $dados->data_inicio;
    $cep_inicio     = $dados->cep_inicio;
    $cep_fim      = $dados->cep_fim;
    $valor      = $dados->valor;
    
    $valor = number_format($valor, 2, ",", ".");
    
  }
?>
 <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- Adicionando Javascript -->
    <script type="text/javascript" >
        $(document).ready(function() {
            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.                
                $("#cidade").val("");               
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
                        $("#cidade").val("...");
                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.                                
                                $("#cidade").val(dados.localidade);                                
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

    <script type="text/javascript" >
        $(document).ready(function() {
            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.                
                $("#cidade2").val("");               
            }            
            //Quando o campo cep perde o foco.
            $("#cep2").blur(function() {
                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');
                //Verifica se campo cep possui valor informado.
                if (cep != "") {
                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;
                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {
                        //Preenche os campos com "..." enquanto consulta webservice.                       
                        $("#cidade2").val("...");
                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.                                
                                $("#cidade2").val(dados.localidade);                                
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
    <form name="cadastro" method="post" action="salvar/rota">

      <div class="form-row">
        <div class="form-group col-md-2">
         <label for="id">ID:</label>
         <input type="text" class="form-control" name="id" value="<?=$id;?>" readonly placeholder="ID">
        </div>
        
        <div class="form-group col-md-2">
         <label for="quantidade">Quantidade:</label>
         <input type="number" class="form-control" name="quantidade" value="<?=$quantidade;?>" required placeholder="Quantidade Max.">
        </div>
        <div class="form-group col-md-2">
         <label for="valor">Valor R$:</label>
         <input type="number" class="form-control" name="valor" value="<?=$valor;?>" required placeholder="Valor R$">
        </div>

        <div class="form-group col-md-2">
         <label for="data">Data Inicio:</label>
         <input type="text" class="form-control mb-2 mr-sm-2" name="data_inicio" value="<?=$data_inicio;?>" data-mask="99/99/9999" required>
        </div>
      
        <div class="form-group col-md-2">
         <label for="cep_inicio">Cep Inicio:</label>
         <input type="text" class="form-control" name="cep_inicio" id="cep" value="<?=$cep_inicio;?>" data-mask="99999-999">
        </div>
        <div class="form-group col-md-2">
         <label for="cep_fim">Cep Fim</label>
         <input type="text" class="form-control" name="cep_fim" id="cep2" value="<?=$cep_fim;?>" data-mask="99999-999">
        </div>
      </div>
          

        <div class="form-row">
         <div class="form-group col-md-2">
          <label for="cidade">Cidade Inicio:</label>
          <input type="text" id="cidade" name="cidade_inicio" readonly class="form-control">         
        </div>
        <div class="form-group col-md-2">
         <label for="cep_fim">Cidade Fim</label>
         <input type="text" class="form-control" id="cidade2" readonly name="cidade_fim">
        </div>
         <div class="form-group col-md-2">
          <label for="tamanho">Tamanho:</label>
          <select name="tamanho" id="tamanho" 
          class="form-control" required data-parsley-required-message="Selecione uma opção">
            <option value="">Selecione</option>
            <?php
              $tabela = "tamanho";
              $campo  =   "descricao";  
              carregarOpcoes($tabela,$campo,$pdo);
            ?>
          </select>
        </div> 
      </div>   
      
          <button type="submit" class="btn btn-outline-success mb-2 mr-sm-2">Gravar Rota</button>
                                                

          
    </form>
 </div>
 <script type="text/javascript">
  $(document).ready(function(){
    

    //aplica a mascara de valor no campo
    $("#valor").maskMoney({
      thousands: ".",
      decimal: ","
    });

   
  })
</script>

