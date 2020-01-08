	<div class="container">
		<table class="table table-bordered table-striped" name="teste">
			<thead>
				<tr>
					
					<td width="10%">ID Rota</td>
					<td>CEP Partida</td>
					<td>CEP Destino</td>
					
					<td>Preço</td>
					<td>Data</td>										
					<td width="12%">Contratar</td>										
				</tr>
			</thead>
			<?php
			$tipo = "";
			if ( !isset ( $_SESSION["tcc"]["tipo"] )) {

				 }else{
				 	$tipo = $_SESSION["tcc"]["tipo"];
				 }
				
				
				//sql da busca por valor
				$sql = "select *, date_format(data_inicio, '%d/%m/%Y') data_inicio from rota";

				$consulta = $pdo->prepare( $sql );
				$consulta = $pdo->prepare($sql);
				$consulta->execute();
					//laço de repetição para separar as linhas
					while ( $linha = $consulta->fetch(PDO::FETCH_OBJ)) {
						//separar os dados
					$id 			= $linha->id;
					$cep_inicio		= $linha->cep_inicio;
					$cep_fim  		= $linha->cep_fim;					
					$valor 			= $linha->valor;
					$data_inicio	= $linha->data_inicio;

					$valor = number_format($valor, 2, ",", ".");

					
          				         //mostrar os dados dentro da linha da tabela (tr)
					echo "<tr>							
							<td>$id</td>
							<td>$cep_inicio</td>
							<td>$cep_fim</td>
							<td>R$: $valor</td>
							<td>$data_inicio</td>
							<td>";
							if ('1'<>$tipo) {
								echo " <a  type='button' href='paginas/home' class='btn btn-danger'>Seja um Cliente</a>";
							}else{
								echo " <a  type='button' href='cadastrar/contratarota/$id' class='btn btn-success'>Contratar</a>";
							}
							echo "
							</td>													
						</tr>";          
				    }
				    //sql da busca por valor
				$sql = "select *, date_format(data_inicio, '%d/%m/%Y') data_inicio, rota.cep_fim, parada.cep, parada.valor, parada.id as 'idd' from parada 
				right join rota on parada.rota_id = rota.id";

				$consulta = $pdo->prepare( $sql );
				$consulta = $pdo->prepare($sql);
				$consulta->execute();
					//laço de repetição para separar as linhas
					while ( $linha = $consulta->fetch(PDO::FETCH_OBJ)) {
						//separar os dados
					$idd 			= $linha->idd;
					$cep 			= $linha->cep;
					$cep_fim  		= $linha->cep_fim;					
					$valor 			= $linha->valor;
					$data_inicio	= $linha->data_inicio;

					$valor = number_format($valor, 2, ",", ".");

					if (isset($cep)) {
						$par = '2';
					}

					
          				         //mostrar os dados dentro da linha da tabela (tr)
					echo "<tr>							
							<td>$idd</td>
							<td>$cep</td>
							<td>$cep_fim</td>
							<td>R$: $valor</td>
							<td>$data_inicio</td>
							<td>";
							if ('1'<>$tipo) {
								echo " <a  type='button' href='paginas/home' class='btn btn-danger'>Seja um Cliente</a>";
							}elseif ($par == '2') {
								echo " <a  type='button' href='cadastrar/contrataparada/$idd' class='btn btn-success'>Contratar parada</a>";
							}
							echo "
							</td>													
						</tr>";          
				    }
								

			?>
		</table>
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