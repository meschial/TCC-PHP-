<?php
//verificar se o arquivo existe
  if ( file_exists ( "verificacliente.php" ) )
    include "verificacliente.php";
  else
    include "../verificacliente.php";

	$id = $_SESSION["tcc"]["id"];

	$sql = "select * from cliente where usuario_id = $id";
					$consulta = $pdo->prepare($sql);
					$consulta->execute();
					$linha = $consulta->fetch(PDO::FETCH_OBJ);
					if (!empty($linha->usuario_id)	) {
						$idd 	= $linha->usuario_id;
					}
					

?>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap4.min.js"></script>
<div class="container">
	<div class="coluna">
		<div class="row">
			<div class="col-10">
				<h1>Listagem de Cliente</h1>
			</div>
			<div class="col-2">
				<?php
				if (!empty($linha->usuario_id)	) {
					echo "";
				}else{
					echo "<a  type='button' href='cadastrar/cliente' class='btn btn-success'>Cadastrar Dados</a>";
				}

				?>
				
			</div>
		</div>
		<table class="table table-hover table-striped table-bordered">
			<thead>
				<tr>
					<td width="10%">ID</td>					
					<td>Opções</td>
				</tr>
			</thead>
			<tbody>
				<?php
					//selecionar os dados do editora
					$sql = "select * from cliente where usuario_id = $id";
					$consulta = $pdo->prepare($sql);
					$consulta->execute();
					//laço de repetição para separar as linhas
					while ( $linha = $consulta->fetch(PDO::FETCH_OBJ)) {
						//separar os dados
						$id 	= $linha->id;
						
						//montar as linhas e colunas da tabela
						echo "<tr>
							<td>$id</td>							
							<td>
								<a  type='button' href='cadastrar/cliente/$id' class='btn btn-outline-primary'>Editar</a>
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
