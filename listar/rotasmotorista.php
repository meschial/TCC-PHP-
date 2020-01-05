<?php
	//verificar se o arquivo existe
	if ( file_exists ( "verificamotorista.php" ) )
		include "verificamotorista.php";
	else
		include "../verificamotorista.php";


	$id = $_SESSION["tcc"]["id"];
	$ativo = $_SESSION["tcc"]["ativo"];	
	
?>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap4.min.js"></script>
<div class="container">
	<div class="coluna">
		<div class="row">
			<div class="col-10">
				<h1>Listagem de Rotas</h1>
			</div>
			<div class="col-2">
				<?php
					if ("n" == $ativo) {
						echo "<a  type='button' href='#' class='btn btn-danger'>Aguarde  ativação</a>";
					}else{
						echo "<a  type='button' href='cadastrar/rotas' class='btn btn-success'>Cadastrar Rotas</a>";
					}
				
				?>				
			</div>
		</div>
		<table class="table table-hover table-striped table-bordered">
			<thead>
				<tr>
					<td width="9%">ID</td>					
					<td width="15%">CEP Partida</td>
					<td width="15%">CEP Destino</td>					
					<td width="15%">Data Inicio</td>					
					<td width="15%">Valor</td>					
					<td width="15%">Cep Parada</td>					
					<td>Opções</td>
				</tr>
			</thead>
			<tbody>
				<?php
					//selecionar os dados do editora
					$sql = "select *, date_format(data_inicio, '%d/%m/%Y') data_inicio from rota where motorista_id = $id";
					$consulta = $pdo->prepare($sql);
					$consulta->execute();
					//laço de repetição para separar as linhas
					while ( $linha = $consulta->fetch(PDO::FETCH_OBJ)) {
						//separar os dados
						$id 			= $linha->id;											
						$cep_inicio 	= $linha->cep_inicio;
						$cep_fim 		= $linha->cep_fim;						
						$data_inicio 	= $linha->data_inicio;
						$valor 			= $linha->valor;
						$valor = number_format($valor, 2, ",", ".");
						//montar as linhas e colunas da tabela
						echo "<tr>
							<td>$id</td>							
							<td>$cep_inicio</td>
							<td>$cep_fim</td>
							<td>$data_inicio</td>							
							<td>R$ $valor</td>							
							<td>
								<a  type='button' href='cadastrar/rotaalternativa/$id' class='btn btn-success'>Nova</a>
								<a  type='button' href='Listar/rotaalternativa/$id' class='btn btn-primary'>Listar</a>	
							</td>							
							<td>
								<a  type='button' href='cadastrar/rotas/$id' class='btn btn-outline-primary'>Editar</a>
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
  $(document).ready(function(){
    

    //aplica a mascara de valor no campo
    $("#valor").maskMoney({
      thousands: ".",
      decimal: ","
    });

   
  });
</script>

<script type="text/javascript">
	//funcao em javascript para perguntar se quer mesmo excluir
	function excluir(id) {
		//perguntar
		if ( confirm("Deseja mesmo excluir? Tem certeza?" ) ) {
			//chamar a tela de exclusão
			location.href = "excluir/rotas/"+id;
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
