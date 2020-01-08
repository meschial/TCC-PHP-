<?php
	
	if ( !isset ( $pagina ) ) {
		header("Location: index.php");
	}
  $id = "";
 $id = $_SESSION["tcc"]["id"];
?>
    <!-- Header Area Starts -->
	<header class="header-area main-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo-area">
                        <a href="index.php"><img src="assets/images/logo.jpg" alt="logo"></a>
                    </div>
                </div>
                <div class="col-lg-10"> 
                <div class="custom-navbar">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>                      
                    <div class="main-menu">
                        <ul>
                            <li class="active"><a href="paginas/home">inicio</a></li>                            
                            <li><a href="listar/todasrotas">Rotas</a></li>
                            <li><a href="#">Vantagens Me Leva</a>
                                <ul class="sub-menu">
                                    <li><a href="#">Motorista</a></li>
                                    <li><a href="#">Cliente</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Contato</a></li>
                            <li><a href="#">Quem Somos</a>
                                <ul class="sub-menu">
                                    <li><a href="#">Marcos</a></li>
                                    <li><a href="#">Adenilson</a></li>                                    
                                </ul>
                            </li>                            
                            <?php
                            	if(isset($_SESSION["tcc"]["id"])){
                            ?>
                            <div class="btn-group">
            										<button type="button" class="btn btn-warning">Olá  <?=$_SESSION["tcc"]["apelido"];?></button>
            										<button type="button" class="btn btn-warning  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">	
            										</button>
            										  <div class="dropdown-menu">
            										    <a class="dropdown-item" href="listar/endereco">Endereço</a>
                                    <?php
                                      if ("2" == $_SESSION["tcc"]["tipo"]) {
                                        echo "<a class='dropdown-item' href='listar/motorista'>Dados CNH</a>";
                                        echo "<a class='dropdown-item' href='listar/rotasmotorista'>Rotas</a>";
                                      }else if("1" == $_SESSION["tcc"]["tipo"]){
                                        echo "<a class='dropdown-item' href='cadastrar/cliente/$id'>Identidade</a>";
                                        echo "<a class='dropdown-item' href='listar/envios'>Envios</a>";
                                        echo "<a class='dropdown-item' href='listar/pagamento'>Pagamentos</a>";
                                      }else if ("3" == $_SESSION["tcc"]["tipo"]){                                        
                                        echo "<a class='dropdown-item' href='listar/ativarcliente'>Ativar Cli.</a>";
                                        echo "<a class='dropdown-item' href='listar/clienteativos'>Desativar Cli.</a>";                                       
                                        echo "<a class='dropdown-item' href='listar/tamanho'>Tamanhos</a>";                                       
                                        
                                      }                                                                   
            										    echo " <a class='dropdown-item' href='cadastrar/usuario/$id'>Editar Dados</a>";
                                    ?>    
            										    <a class="dropdown-item" href="sair.php">Sair</a>									    
            										  </div>
            								</div>
            						  	<?php								      
            								  }else{
            								    echo '<li class="menu-btn">
            								   			    <button type="button" href="#login" data-toggle="modal" data-target="#login" class="btn btn-warning">LOGIN</button>	   			
            								   		    </li>';
            								  }
                        		?>            				                       
                      </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
            <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <form class="form-inline" name="login" method="post" action="logar/login">                    
                      <label class="sr-only" for="cpf">CPF</label>
                      <input type="text" class="form-control mb-2 mr-sm-2" name="cpf" data-Mask="999.999.999-99" placeholder="Digite seu cpf">

                      <label class="sr-only" for="senha">Senha</label>
                      <input type="password" class="form-control mb-2 mr-sm-2" name="senha"  placeholder="Digite sua senha">                       
                      <button type="submit"  class="btn btn-outline-success">Acessar</button> 
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>                   
                  </div>
                </div>
              </div>
            </div> 
  </header>
  <!-- Header Area End -->     
            
<main>
  <div style="margin: 0 50px;">
    <?php
      if ( file_exists ( $pagina ) ) include $pagina;
      else include "paginas/erro.php";
    ?>
  </div>
</main>

		<script type="text/javascript">
             $('#login').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) //Botão que acionou o modal
              var recipient = button.data('whatever')
              var modal = $(this)
              modal.find('.modal-title').text('New message to ' + recipient)
              modal.find('.modal-body input').val(recipient)
            })
   </script>

   <script type="text/javascript">
      $('.dropdown-toggle').dropdown();
  </script>



	