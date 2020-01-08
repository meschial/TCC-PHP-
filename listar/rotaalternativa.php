<?php
	//verificar se o arquivo existe
	if ( file_exists ( "verificamotorista.php" ) )
		include "verificamotorista.php";
	else
		include "../verificamotorista.php";
	
?>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap4.min.js"></script>
<div class="container">
	<div class="coluna">
		<div class="row">
			<div class="col-10">
				<h1>Listagem de Rotas</h1>
			</div>			
		</div>
		<table class="table table-hover table-striped table-bordered">
			<thead>
				<tr>
					<td width="9%">ID</td>
					<td width="15%">CEP Destino</td>					
					<td width="15%">Valor</td>						
					<td>Opções</td>
				</tr>
			</thead>
			<tbody>
				<?php
				if ( isset ( $p[2] ) ) {
					$id = (int)$p[2];
					//selecionar os dados do editora
					$sql = "select parada.id, parada.cep, parada.valor from parada
					inner join rota 
					on rota.id = parada.rota_id
					 where parada.rota_id = $id";
					$consulta = $pdo->prepare($sql);
					$consulta->execute();
				}
					//laço de repetição para separar as linhas
					while ( $linha = $consulta->fetch(PDO::FETCH_OBJ)) {
						//separar os dados
						$id 	= $linha->id;											
						$cep	= $linha->cep;
						$valor 	= $linha->valor;
						$valor = number_format($valor, 2, ",", ".");
						//montar as linhas e colunas da tabela
						echo "<tr>
							<td>$id</td>							
							<td>$cep</td>							
							<td>R$ $valor</td>														
							<td>
								<a  type='button' href='listar/rotasmotorista' class='btn btn-outline-primary'>Voltar</a>
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
			location.href = "excluir/rotaalternativa/"+id;
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
