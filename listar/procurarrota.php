	<div class="container">
		<table class="table table-bordered table-striped" name="teste">
			<thead>				
				<tr>
					
					<td width="10%">ID Rota</td>
					<td>CEP Partida</td>
					<td>CEP Destino</td>
					<td>Data Partida</td>
					
					<td>Preço</td>
					<td>Tamanho</td>										
					<td width="12%">Contratar</td>										
				</tr>
			</thead>
			<?php
			$tipo = "";
			if ( !isset ( $_SESSION["tcc"]["tipo"] )) {

				 }else{
				 	$tipo = $_SESSION["tcc"]["tipo"];
				 }
				

				//iniciar os valores
				$cep_inicio = $cep_fim = "";
				//verificar se foram enviados
				if ( isset ( $_POST["cep_inicio"] ) ) {
					$cep_inicio = trim ( $_POST["cep_inicio"] );
				}
				if ( isset ( $_POST["cep_fim"] ) ) {
					$cep_fim = trim ( $_POST["cep_fim"] );
				}
				if ( isset ( $_POST["data_inicio"] ) ) {
					$data_inicio = trim ( $_POST["data_inicio"] );
				}
				$data_inicio = formataData( $data_inicio );
				//sql da busca por valor
				 $sql = "select parada.idparada, parada.cep, parada.valo, rota.cep_inicio, rota.cep_fim, rota.id, rota.valor, tamanho.descricao, date_format(data_inicio, '%d/%m/%Y') data_inicio from rota
				 		left outer join parada on rota.id = parada.rota_id 				 		
				 		inner join tamanho on tamanho.id = rota.tamanho_id
			            where rota.cep_inicio = :cep_inicio
			            and rota.cep_fim = :cep_fim
			            and rota.data_inicio = :data_inicio			            
			            or parada.cep = :cep_inicio group by id";

				$consulta = $pdo->prepare( $sql );
				$consulta->bindValue(":cep_inicio",$cep_inicio);
				$consulta->bindValue(":cep_fim",$cep_fim);	
				$consulta->bindValue(":data_inicio",$data_inicio);	
					
				$consulta->execute();				
				while ( $linha = $consulta->fetch(PDO::FETCH_OBJ) )
				{					
					//recuperar as variaveis
					$id 			= $linha->id;
					$idparada		= $linha->idparada;
					$cep_i			= $linha->cep_inicio;
					$cep 			= $linha->cep;
					$cep_fim  		= $linha->cep_fim;					
					$valor 			= $linha->valor;
					$valorpa 		= $linha->valo;
					$tamanho 	 	= $linha->descricao;
					$data_inicio 	= $linha->data_inicio;					

					if ($cep_inicio == $cep_i)  {
						$teste 	= $cep_i;
						$novo 	= $valor;
						$novoid 	= $id;
						$modo = '1';
					}else {
						$teste 	= $cep;
						$novo 	= $valorpa;						
						$novoid 	= $idparada;
						$modo = '2';						
					}					

         			  $novo = number_format($novo, 2, ",", ".");
				         //mostrar os dados dentro da linha da tabela (tr)
					echo "<tr>							
							<td>$novoid</td>
							<td>$teste</td>
							<td>$cep_fim</td>
							<td>$data_inicio</td>
							<td>R$: $novo</td>
							<td>$tamanho</td>
							<td>";
							if ('1'<>$tipo) {
								echo " <a  type='button' href='paginas/home' class='btn btn-danger'>Seja um Cliente</a>";
							}elseif ($modo=='1') {					
								echo " <a  type='button' href='cadastrar/contratarota/$novoid' class='btn btn-success'>Contratar rota</a>";
							}else{
								echo " <a  type='button' href='cadastrar/contrataparada/$novoid' class='btn btn-success'>Contratar parada</a>";
							}
							echo "
							</td>													
						</tr>";           
				    }
								

			?>
		</table>
	</div>

 <!-- Modal cliente -->
            <div class="modal fade" id="cadastro" tabindex="-1" role="dialog" aria-labelledby="cadastro" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">

                    <form class="form-inline" name="cadastro" method="post" action="salvar/usuario">
                      <label class="sr-only" for="id">Id</label>
                      <input  class="id" name="id">

                       <label class="sr-only" for="nome">Nome</label>
                      <input type="text" class="form-control mb-2 col-sm-9" name="nome" required placeholder="Digite seu nome completo">

                       <label class="sr-only" for="cpf">CPF</label>
                      <input type="text" class="form-control mb-2 mr-sm-2 col-sm-6" name="cpf" data-Mask="999.999.999-99" required placeholder="Digite seu cpf">

                       <label class="sr-only" for="rg">RG</label>
                      <input type="text" class="form-control mb-2 col-sm-5" name="rg" required placeholder="Digite seu rg">

                       <label class="sr-only" for="data">Data</label>
                      <input type="text" class="form-control mb-2 mr-sm-2 col-sm-4" name="data" data-Mask="99/99/9999" required placeholder="Data Nascimento">                    

                      <label class="sr-only" for="email">E-mail</label>
                      <input type="email" class="form-control mb-2 mr-sm-2 col-sm-7" name="email" required  placeholder="digite seu E-mail">

                      <label class="sr-only" for="celular">Celular</label>
                      <input type="text" class="form-control mb-2 mr-sm-2 col-sm-5" name="celular" data-Mask="(99)99999-9999" required placeholder="Número do Celular">

                      <label class="sr-only" for="celular2">Celular2</label>
                      <input type="text" class="form-control mb-2 mr-sm-2 col-sm-6" name="celular2" data-Mask="(99)99999-9999" placeholder="Númeor do Celular II">

                      <label class="sr-only" for="senha">Senha</label>
                      <input type="password" class="form-control mb-2 mr-sm-2 col-sm-5" name="senha" required placeholder="Digite sua senha">

                      <label class="sr-only" for="senha">Senha</label>
                      <input type="password" class="form-control mb-2 mr-sm-2 col-sm-6" name="senha" required placeholder="Confirme sua senha">

                      <label class="sr-only" for="tipo">Tipo</label>
                      <input type="text" hidden  value="1" readonly name="tipo">  

                      <input type="text"   value="n" hidden  name="ativo">     

                      <label class="sr-only" for="apelido">Apelido</label>
                      <input type="text" class="form-control mb-2 mr-sm-4 col-sm-8" name="apelido" placeholder="Como gostaria de ser chamado?" required>                               

                      <button type="submit" class="btn btn-outline-success mb-2 mr-sm-2">Cadastrar</button>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>                   
                  </div>
                </div>
              </div>
            </div>



<script type="text/javascript">
	//funcao em javascript para perguntar se quer mesmo excluir

	$(document).ready( function () {
	    $('.table').DataTable( {
        "language": {
            "lengthMenu": "Mostrar _MENU_ resultados por página",
            "zeroRecords": "Nenhum registro encontrado",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtrando de _MAX_ em um total de registros)",
            "search":"Buscar",
            "Previous":"Anterior"
        }
    });
	});
</script>