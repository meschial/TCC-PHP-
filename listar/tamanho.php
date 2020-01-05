<?php
  if ( file_exists ( "verificasuper.php" ) )
    include "verificasuper.php";
  else
    include "../verificasuper.php";

	$id = $_SESSION["tcc"]["id"];
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
					<td width="5%">ID</td>
					<td width="15%">Descrição</td>
					<td width="15%">Peso</td>
					<td width="15%">Lagura</td>
					<td width="15%">Comprimento</td>
					<td width="15%">Altura</td>
					<td>Opções</td>
				</tr>
			</thead>
			<tbody>
				<?php
					//selecionar os dados do editora
					$sql = "select * from tamanho";
					$consulta = $pdo->prepare($sql);
					$consulta->execute();
					//laço de repetição para separar as linhas
					while ( $linha = $consulta->fetch(PDO::FETCH_OBJ)) {
						//separar os dados
						$id 			= $linha->id;
						$descricao 		= $linha->descricao;
						$peso 			= $linha->peso;
						$largura 		= $linha->largura;
						$comprimento 	= $linha->comprimento;
						$altura 	= $linha->altura;
						//montar as linhas e colunas da tabela
						echo "<tr>
							<td>$id</td>
							<td>$descricao</td>
							<td>$peso</td>
							<td>$largura</td>
							<td>$comprimento</td>
							<td>$altura</td>
							<td>
								<a type='button' href='cadastrar/tamanho/$id' class='btn btn-success'>Editar</a>								
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
			location.href = "excluir/tamanho/"+id;
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