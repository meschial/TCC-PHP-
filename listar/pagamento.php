<?php


	$cliente = $_SESSION["tcc"]["id"];
	$nome = $_SESSION["tcc"]["apelido"];
?>
<div class="container">
	<div class="form-row">
				<?php


					//selecionar os dados do editora
					$sql = "select venda.id, venda.valor, date_format(data_venda, '%d/%m/%Y') data_venda from venda 
					inner join item on venda.item_id = item.id
					where item.cliente_id = $cliente order by id";
					$consulta = $pdo->prepare($sql);
					$consulta->execute();
					//laço de repetição para separar as linhas
					while ( $linha = $consulta->fetch(PDO::FETCH_OBJ)) {
						//separar os dados
						$id				= $linha->id;
						$valor 			= $linha->valor;
						$data_venda 	= $linha->data_venda;

						$valor = number_format($valor, 2, ",", ".");
				

						echo "
				    		<div class='form-group col-md-4'>
								<div class='card border-warning '>
									<div class='card-header'>
										<h4 class='card-title'><b>Cliente: $nome </b></h4>
										<p hidden>ID:[$id]</p>
									</div>
									<ul class='list-group list-group-flush'>
										<li class='list-group-item'>Data Venda: $data_venda </li>
										<li class='list-group-item'>Valor Total: $valor</li>
									</ul>
									<div class='card-body'>
										<a type='button' href='cadastrar/pagamento/$id' class='btn btn-outline-success'>Finalizar</a>			
										<a type='button' href='javascript:excluir($id)' class='btn btn-outline-danger'>Cancelar</a>						
									</div>
								</div>
							</div>";
					}
				?>
	</div>
</div>
