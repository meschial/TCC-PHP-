<?php
	$id = $_SESSION["tcc"]["id"];
?>
<div class="container">
	<div class="coluna">
		<h1>Listagem de Clientes</h1>
		<table class="table table-hover table-striped table-bordered">
			<thead>
				<tr>
					<td width="10%">ID</td>
					<td width="40%">Nome do Cliente</td>
					<td width="30%">Celular</td>
					<td>Opções</td>
				</tr>
			</thead>
			<tbody>
				<?php
					//selecionar os dados do editora
					$sql = "select * from usuario where id = $id;";
					$consulta = $pdo->prepare($sql);
					$consulta->execute();
					//laço de repetição para separar as linhas
					while ( $linha = $consulta->fetch(PDO::FETCH_OBJ)) {
						//separar os dados
						$id 		= $linha->id;
						$nome 		= $linha->nome;
						$celular 	= $linha->celular;
						//montar as linhas e colunas da tabela
						echo "<tr>
							<td>$id</td>
							<td>$nome</td>
							<td>$celular</td>
							<td>
								<a type='button' href='cadastrar/usuario/$id' class='btn btn-success'>Editar Dados</a>								
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
			location.href = "excluir/cliente/"+id;
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