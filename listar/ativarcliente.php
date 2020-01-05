<?php
//verificar se o arquivo existe
	if ( file_exists ( "verificasuper.php" ) )
		include "verificasuper.php";
	else
		include "../verificasuper.php";

?>
<div class="row">
	<div class="col">
	<div class="coluna">
		<h1>Listagem de Clientes</h1>
		<table class="table table-hover table-striped table-bordered">
			<thead>
				<tr>
					<td width="10%">ID</td>
					<td width="30%">Nome do Cliente</td>
					<td width="20%">Celular</td>
					<td width="20%">Tipo</td>
					<td>Opções</td>
				</tr>
			</thead>
			<tbody>
				<?php

					//selecionar os dados do editora
					$sql = "select usuario.id, usuario.tipo, usuario.nome,  usuario.celular from cliente
				            inner join usuario
				            on  usuario.id = cliente.usuario_id 
				            where usuario.ativo = 'n'
							and tipo = '1'";
					
					$consulta = $pdo->prepare($sql);
					$consulta->execute();
					//laço de repetição para separar as linhas
					while ( $linha = $consulta->fetch(PDO::FETCH_OBJ)) {
						//separar os dados
						$id 		= $linha->id;
						$nome 		= $linha->nome;
						$celular 	= $linha->celular;
						$tipo 	= $linha->tipo;
						//montar as linhas e colunas da tabela
						if ('1' == $tipo) {
							$novotipo = 'Cliente';
						}else{
							$novotipo = 'Motorista';
						}
						//super if
						if ('3' == $tipo) {
							$novotipo = 'Super';
						}
						echo "<tr>
							<td>$id</td>
							<td>$nome</td>
							<td>$celular</td>
							<td>$novotipo</td>
							<td>
								<a type='button' href='cadastrar/ativarcliente/$id' class='btn btn-success'>Ver dados</a>								
							</td>
						</tr>";
					}
				?>
			</tbody>
		</table>
	</div>
	</div>

	<div class="col">
	<div class="coluna">
		<h1>Listagem de Motorista</h1>
		<table class="table table-hover table-striped table-bordered">
			<thead>
				<tr>
					<td width="10%">ID</td>
					<td width="30%">Nome do Motorista</td>
					<td width="20%">Celular</td>
					<td width="20%">Tipo</td>
					<td>Opções</td>
				</tr>
			</thead>
			<tbody>
				<?php

					//selecionar os dados do editora
					$sql = "select usuario.id, usuario.tipo, usuario.nome,  usuario.celular from motorista
				            inner join usuario
				            on  usuario.id = motorista.usuario_id 
				            where usuario.ativo = 'n'
							and tipo = '2'";
					
					$consulta = $pdo->prepare($sql);
					$consulta->execute();
					//laço de repetição para separar as linhas
					while ( $linha = $consulta->fetch(PDO::FETCH_OBJ)) {
						//separar os dados
						$id 		= $linha->id;
						$nome 		= $linha->nome;
						$celular 	= $linha->celular;
						$tipo 	= $linha->tipo;
						//montar as linhas e colunas da tabela
						if ('1' == $tipo) {
							$novotipo = 'Cliente';
						}else{
							$novotipo = 'Motorista';
						}
						//super if
						if ('3' == $tipo) {
							$novotipo = 'Super';
						}
						echo "<tr>
							<td>$id</td>
							<td>$nome</td>
							<td>$celular</td>
							<td>$novotipo</td>
							<td>
								<a type='button' href='cadastrar/ativarmotorista/$id' class='btn btn-success'>Ver dados</a>								
							</td>
						</tr>";
					}
				?>
			</tbody>
		</table>
	</div>
	</div>
</div>
<script type="text/javascript">

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