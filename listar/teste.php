
<div class="container">
	<div class="coluna">
		<div class="row">
			<div class="col-lg-10">
                <h1>Listagem de Produtos</h1>
             </div>			
			<div class="col-lg-2">
                <a  type='button' href='cadastrar/Produto' class='btn btn-success'>Novos Produtos</a>
             </div>			
		</div>
						<div class="container">
							<div class="form-row">
		
				<?php				
					//selecionar os dados do editora
					$sql = "select * from produto where item_id = '1'";
					$consulta = $pdo->prepare($sql);
					$consulta->execute();
					//laço de repetição para separar as linhas
					while ( $linha = $consulta->fetch(PDO::FETCH_OBJ)) {
						//separar os dados
						$id 			= $linha->id;
						$nome 			= $linha->nome;
						$peso 			= $linha->peso;
						$largura 		= $linha->largura;
						$comprimento 	= $linha->comprimento;
						$altura 		= $linha->altura;
						//montar as linhas e colunas da tabela
						echo "
				    				<div class='form-group col-md-4'>
										<div class='card'>
										  <div class='card-body'>
										    <h4 class='card-title'>Nome: $nome </h4>
										    <p hidden>ID:[$id]</p>
										  </div>
										  <ul class='list-group list-group-flush'>
										    <li class='list-group-item'>Peso: $peso</li>
										    <li class='list-group-item'>Largura: $largura</li>
										    <li class='list-group-item'>Comprimento: $comprimento</li>
										  </ul>
										  <div class='card-body'>
										    <a href='#' class='card-link'>Comprar</a>
										    <a href='#' class='card-link'>Excluir</a>
										  </div>
										</div>
									</div>";
					}
				?>

								</div>
							</div>