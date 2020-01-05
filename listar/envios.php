<?php


	$idd = $_SESSION["tcc"]["id"];
?>
<div class="container">
	<div class="coluna">
		<div class="row">
			<div class="col-lg-10">
                <h1>Listagem de Tamanhos</h1>
             </div>
			
			<div class="col-lg-2">
                <a  type='button' href='cadastrar/tamanho' class='btn btn-success'>Novos Tamanhos</a>
             </div>
			
		</div>
		
		<table class="table table-hover table-striped table-bordered">

			<thead>
				<tr>
					<td width="10%">ID item</td>
					<td width="15%">status</td>
					<td width="15%">data</td>
					<td width="15%">rota</td>
					<td width="15%">Enviar produtos</td>
					<td>Opções</td>
				</tr>
			</thead>
			<tbody>
				<?php


					//selecionar os dados do editora
					$sql = "select *, date_format(data_venda, '%d/%m/%Y') data_venda from item where cliente_id = $idd";
					$consulta = $pdo->prepare($sql);
					$consulta->execute();
					//laço de repetição para separar as linhas
					while ( $linha = $consulta->fetch(PDO::FETCH_OBJ)) {
						//separar os dados
						$id				= $linha->id;
						$parada			= $linha->parada_id;
						$status 		= $linha->status;
						$data_venda 	= $linha->data_venda;
						$rota_id 		= $linha->rota_id;

						if ('0' == $parada) {
							$id = $id;
						}else{
							$id = $parada;
						}
						//montar as linhas e colunas da tabela
						echo "<tr>
							<td>$id</td>
							<td>$status</td>
							<td>$data_venda</td>
							<td>$rota_id</td>
							<td>";
									if ('0' == $parada) {
									echo "	<a type='button' href='cadastrar/produto/$id' class='btn btn-success'>Rota</a>	
									<a type='button' href='listar/produto/$id' class='btn btn-success'>Listar</a>	";
									}else{
									echo "	<a type='button' href='javascript:excluir($id)' class='btn btn-danger'>Parada</a>";
									}

								echo "
								
							</td>
							<td>
								<a type='button' href='cadastrar/vendafim/$id' class='btn btn-success'>Editar</a>								
								<a type='button' href='javascript:excluir($id)' class='btn btn-danger'>Excluir</a>								
							</td>
						</tr>";
					}
				?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	//funcao em javascript para perguntar se quer mesmo excluir
	function excluir(id) {
		//perguntar
		if ( confirm("Deseja mesmo excluir? Tem certeza?" ) ) {
			//chamar a tela de exclusão
			location.href = "excluir/contratarota/"+id;
		}
	}
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