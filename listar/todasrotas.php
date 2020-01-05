	<div class="container">
		<table class="table table-bordered table-striped" name="teste">
			<thead>
				<tr>
					
					<td width="10%">ID Rota</td>
					<td>CEP Partida</td>
					<td>CEP Destino</td>
					
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
				
				
				//sql da busca por valor
				 $sql = "select rota.id, rota.cep_inicio, rota.cep_fim, rota.valor, tamanho.descricao from rota
				 inner join tamanho on rota.tamanho_id = tamanho.id";

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
					$tamanho 	= $linha->descricao;

					$valor = number_format($valor, 2, ",", ".");

					
          				         //mostrar os dados dentro da linha da tabela (tr)
					echo "<tr>							
							<td>$id</td>
							<td>$cep_inicio</td>
							<td>$cep_fim</td>
							<td>R$: $valor</td>
							<td>$tamanho</td>
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