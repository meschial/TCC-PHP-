<?php
//verifica se esta logado
 if  ( !isset ( $_SESSION["tcc"]["id"] ) ) {
    echo "<script>location.href='paginas/home'</script>";
  }
	$id = $_SESSION["tcc"]["id"];
?>

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


			<div class="container">
				<div class="form-row">
		
				<?php
					//selecionar os dados do editora
					$sql = "select * from endereco where usuario_id = $id";
					$consulta = $pdo->prepare($sql);
					$consulta->execute();
					//laço de repetição para separar as linhas
					while ( $linha = $consulta->fetch(PDO::FETCH_OBJ)) {
						//separar os dados
						$id 		 = $linha->id;
						$cep 		 = $linha->cep;
						$cidade 	 = $linha->cidade;
						$complemento = $linha->complemento;
						$rua 		 = $linha->rua;
						$estado 	 = $linha->estado;
						$numero 	 = $linha->numero;
						//montar as linhas e colunas da tabela
						echo "
				    		<div class='form-group col-md-4'>
								<div class='card border-success'>
									<div class='card-header'>
										<h4 class='card-title'><b>Cidade: $cidade / UF: $estado</b></h4>
										<p hidden>ID:[$id]</p>
									</div>
									<ul class='list-group list-group-flush'>
										<li class='list-group-item'>CEP: $cep</li>
										<li class='list-group-item'>Complemento: $complemento</li>
										<li class='list-group-item'>Rua: $rua / N:$numero</li>
									</ul>
									<div class='card-body'>
										<a  type='button' href='cadastrar/endereco/$id' class='btn btn-outline-primary'>Editar Endereço</a>
										<a  type='button' href='javascript:excluir($id)' class='btn btn-outline-danger'>Excluir Endereço</a>	
									</div>
								</div>
							</div>";
					}
				?>

				</div>
			</div>

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
</script>
