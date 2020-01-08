<div class="container">
	<div class="form-row">
			<?php
			$tipo = "";
			if ( !isset ( $_SESSION["tcc"]["tipo"] )) {

				 }else{
				 	$tipo = $_SESSION["tcc"]["tipo"];
				 }
				
				
				//sql da busca por valor
				$sql = "select *, date_format(data_inicio, '%d/%m/%Y') data_inicio from rota";

				$consulta = $pdo->prepare( $sql );
				$consulta = $pdo->prepare($sql);
				$consulta->execute();
					//laço de repetição para separar as linhas
					while ( $linha = $consulta->fetch(PDO::FETCH_OBJ)) {
						//separar os dados
					$id 			= $linha->id;
					$cidade_inicio	= $linha->cidade_inicio;
					$cidade_fim		= $linha->cidade_fim;
					$cep_inicio		= $linha->cep_inicio;
					$cep_fim  		= $linha->cep_fim;					
					$valor 			= $linha->valor;
					$data_inicio	= $linha->data_inicio;

					$valor = number_format($valor, 2, ",", ".");

					echo "
				    		<div class='form-group col-md-4'>
								<div class='card'>
									<div class='card-body'>
										<h4 class='card-title'>Rota: $cidade_inicio / $cidade_fim </h4>
										<p hidden>ID:[$id]</p>
									</div>
									<ul class='list-group list-group-flush'>
										<li class='list-group-item'>CEP: $cep_inicio / $cep_fim</li>
										<li class='list-group-item'>Data Rota: $data_inicio</li>
										<li class='list-group-item'>Valor: $valor</li>
									</ul>
									<div class='card-body'>";
									if ('1'<>$tipo) {
										echo " <a  type='button' href='paginas/home' class='btn btn-danger'>Seja um Cliente</a>";
									}else{
										echo " <a  type='button' href='cadastrar/contratarota/$id' class='btn btn-success'>Contratar</a>";
									}
									echo "								
									</div>
								</div>
							</div>";
					}
				$sql = "select *, date_format(data_inicio, '%d/%m/%Y') data_inicio, rota.cep_fim, rota.cidade_inicio, rota.cidade_fim, parada.cep, parada.valor, parada.id as 'idd' from parada 
				right join rota on parada.rota_id = rota.id";

				$consulta = $pdo->prepare( $sql );
				$consulta = $pdo->prepare($sql);
				$consulta->execute();
					//laço de repetição para separar as linhas
					while ( $linha = $consulta->fetch(PDO::FETCH_OBJ)) {
						//separar os dados
					$idd 			= $linha->idd;
					$cep 			= $linha->cep;
					$cep_fim  		= $linha->cep_fim;					
					$valor 			= $linha->valor;
					$data_inicio	= $linha->data_inicio;
					$cidade_inicio	= $linha->cidade_inicio;
					$cidade_fim		= $linha->cidade_fim;

					$valor = number_format($valor, 2, ",", ".");

					if (isset($cep)) {
						$par = '2';
					}

					echo "
				    		<div class='form-group col-md-4'>
								<div class='card'>
									<div class='card-body'>
										<h4 class='card-title'>Rota: $cidade_inicio / $cidade_fim </h4>
										<p hidden>ID:[$idd]</p>
									</div>
									<ul class='list-group list-group-flush'>
										<li class='list-group-item'>CEP: $cep / $cep_fim</li>
										<li class='list-group-item'>Data Rota: $data_inicio</li>
										<li class='list-group-item'>Valor: $valor</li>
									</ul>
									<div class='card-body'>";
									if ('1'<>$tipo) {
										echo " <a  type='button' href='paginas/home' class='btn btn-danger'>Seja um Cliente</a>";
									}elseif ($par == '2') {
										echo " <a  type='button' href='cadastrar/contrataparada/$idd' class='btn btn-success'>Contratar parada</a>";
									}
									echo "								
									</div>
								</div>
							</div>";
				    }								

			?>
			
</div>
</div>
