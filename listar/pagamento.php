<?php


	$cliente = $_SESSION["tcc"]["id"];
	$nome = $_SESSION["tcc"]["apelido"];
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
					<td width="10%">ID</td>
					<td width="15%">Valor</td>
					<td width="15%">Nome</td>
					<td>Opções</td>
				</tr>
			</thead>
			<tbody>
				<?php


					//selecionar os dados do editora
					$sql = "select venda.id, venda.valor from venda 
					inner join item on venda.item_id = item.id
					where item.cliente_id = $cliente";
					$consulta = $pdo->prepare($sql);
					$consulta->execute();
					//laço de repetição para separar as linhas
					while ( $linha = $consulta->fetch(PDO::FETCH_OBJ)) {
						//separar os dados
						$id				= $linha->id;
						$valor 		= $linha->valor;

						$valor = number_format($valor, 2, ",", ".");

						
						//montar as linhas e colunas da tabela
						echo "<tr>
							<td>$id</td>
							<td>$valor</td>
							<td>$nome</td>							
							<td>
								<a type='button' href='cadastrar/pagamento/$id' class='btn btn-success'>Enviar</a>								
								<a type='button' href='javascript:excluir($id)' class='btn btn-danger'>Cancelar</a>								
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