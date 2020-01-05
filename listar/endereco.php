<?php
//verifica se esta logado
 if  ( !isset ( $_SESSION["tcc"]["id"] ) ) {
    echo "<script>location.href='paginas/home'</script>";
  }

	$id = $_SESSION["tcc"]["id"];
?>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap4.min.js"></script>
<div class="container">
	<div class="coluna">
		<div class="row">
			<div class="col-10">
				<h1>Listagem de Endereço</h1>
			</div>
			<div class="col-2">
				<a  type="button" href="cadastrar/endereco" class="btn btn-success">Cadast. Endereço</a>
			</div>
		</div>
		<table class="table table-hover table-striped table-bordered">
			<thead>
				<tr>
					<td width="10%">ID</td>
					<td width="40%">CEP</td>
					<td width="30%">Cidade</td>
					<td>Opções</td>
				</tr>
			</thead>
			<tbody>
				<?php
					//selecionar os dados do editora
					$sql = "select * from endereco where usuario_id = $id";
					$consulta = $pdo->prepare($sql);
					$consulta->execute();
					//laço de repetição para separar as linhas
					while ( $linha = $consulta->fetch(PDO::FETCH_OBJ)) {
						//separar os dados
						$id 	= $linha->id;
						$cep 	= $linha->cep;
						$cidade = $linha->cidade;
						//montar as linhas e colunas da tabela
						echo "<tr>
							<td>$id</td>
							<td>$cep</td>
							<td>$cidade</td>
							<td>
								<a  type='button' href='cadastrar/endereco/$id' class='btn btn-outline-primary'>Editar</a>
								<a  type='button' href='javascript:excluir($id)' class='btn btn-danger'>Excluir</a>															
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
			location.href = "excluir/endereco/"+id;
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
