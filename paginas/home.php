<!-- Banner Area Starts -->
    <section class="banner-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 px-0">
                    <div class="banner-bg"></div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="banner-text">
                        <h1>envie todas as suas encomendas fácil e rápido com a <span>me leva!</span></h1>
                        <p class="py-3">
                          O Projeto ME LEVA se trata de um sistema de entrega de produtos, encomendas, cartas... É
                          um sistema de interface simples e de fácil acesso,  
                          depois do cadastro aprovado qualquer pessoa pode levar ou enviar uma encomenda.
                          Basta fazer seu cadastro e achar o melhor preço</p>                        
                         <!-- botão do modal -->
                         <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#cadastro">Cliente MeLeva</button>
                         <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#motorista">Motorista MeLeva</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
        
            <!-- Modal cliente -->
            <div class="modal fade" id="cadastro" tabindex="-1" role="dialog" aria-labelledby="cadastro" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">

                    <form class="form-inline" name="cadastro" method="post" action="salvar/usuario">
                      <label class="sr-only" for="id">Id</label>
                      <input type="text" class="form-control mb-2 mr-sm-2 col-sm-2" name="id" readonly placeholder="ID">

                       <label class="sr-only" for="nome">Nome</label>
                      <input type="text" class="form-control mb-2 col-sm-9" name="nome" required placeholder="Digite seu nome completo">

                       <label class="sr-only" for="cpf">CPF</label>
                      <input type="text" class="form-control mb-2 mr-sm-2 col-sm-6" name="cpf" data-Mask="999.999.999-99" required placeholder="Digite seu cpf">

                       <label class="sr-only" for="rg">RG</label>
                      <input type="text" class="form-control mb-2 col-sm-5" name="rg" required placeholder="Digite seu rg">

                       <label class="sr-only" for="data">Data</label>
                      <input type="text" class="form-control mb-2 mr-sm-2 col-sm-4" name="data" data-Mask="99/99/9999" required placeholder="Data Nascimento">                    

                      <label class="sr-only" for="email">E-mail</label>
                      <input type="email" class="form-control mb-2 mr-sm-2 col-sm-7" name="email" required  placeholder="digite seu E-mail">

                      <label class="sr-only" for="celular">Celular</label>
                      <input type="text" class="form-control mb-2 mr-sm-2 col-sm-5" name="celular" data-Mask="(99)99999-9999" required placeholder="Número do Celular">

                      <label class="sr-only" for="celular2">Celular2</label>
                      <input type="text" class="form-control mb-2 mr-sm-2 col-sm-6" name="celular2" data-Mask="(99)99999-9999" placeholder="Númeor do Celular II">

                      <label class="sr-only" for="senha">Senha</label>
                      <input type="password" class="form-control mb-2 mr-sm-2 col-sm-5" name="senha" required placeholder="Digite sua senha">

                      <label class="sr-only" for="senha">Senha</label>
                      <input type="password" class="form-control mb-2 mr-sm-2 col-sm-6" name="senha" required placeholder="Confirme sua senha">

                      <label class="sr-only" for="tipo">Tipo</label>
                      <input type="text" hidden  value="1" readonly name="tipo">  

                      <input type="text"   value="n" hidden  name="ativo">     

                      <label class="sr-only" for="apelido">Apelido</label>
                      <input type="text" class="form-control mb-2 mr-sm-4 col-sm-8" name="apelido" placeholder="Como gostaria de ser chamado?" required>                               

                      <button type="submit" class="btn btn-outline-success mb-2 mr-sm-2">Cadastrar</button>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>                   
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal motorista -->
            <div class="modal fade" id="motorista" tabindex="-1" role="dialog" aria-labelledby="motorista" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de motorista</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="form-inline" name="cadastro" method="post" action="salvar/usuario">
                      <label class="sr-only" for="id">Id</label>
                      <input type="text" class="form-control mb-2 mr-sm-2 col-sm-2" name="id" readonly placeholder="ID">

                       <label class="sr-only" for="nome">Nome</label>
                      <input type="text" class="form-control mb-2 col-sm-9" name="nome" placeholder="Digite seu nome completo">

                       <label class="sr-only" for="cpf">CPF</label>
                      <input type="text" class="form-control mb-2 mr-sm-2 col-sm-6" name="cpf" data-Mask="999.999.999-99" required placeholder="Digite seu cpf">

                       <label class="sr-only" for="rg">RG</label>
                      <input type="text" class="form-control mb-2 col-sm-5" name="rg" placeholder="Digite seu rg">

                       <label class="sr-only" for="data">Data</label>
                      <input type="text" class="form-control mb-2 mr-sm-2 col-sm-4" name="data" data-Mask="99/99/9999" required placeholder="Data Nascimento">                    

                      <label class="sr-only" for="email">E-mail</label>
                      <input type="text" class="form-control mb-2 mr-sm-2 col-sm-7" name="email"  placeholder="digite seu E-mail">

                      <label class="sr-only" for="celular">Celular</label>
                      <input type="text" class="form-control mb-2 mr-sm-2 col-sm-5" name="celular" data-Mask="(99)99999-9999" required placeholder="Número do Celular">

                      <label class="sr-only" for="celular2">Celular2</label>
                      <input type="text" class="form-control mb-2 mr-sm-2 col-sm-6" name="celular2" data-Mask="(99)99999-9999" placeholder="Númeor do Celular II">

                      <label class="sr-only" for="senha">Senha</label>
                      <input type="password" class="form-control mb-2 mr-sm-2 col-sm-5" name="senha" required placeholder="Digite sua senha">

                      <label class="sr-only" for="senha">Senha</label>
                      <input type="password" class="form-control mb-2 mr-sm-2 col-sm-6" name="senha" required placeholder="Confirme sua senha">

                      <label class="sr-only" for="tipo">Tipo</label>
                      <input type="text" hidden  value="2" readonly name="tipo">  

                      <label class="sr-only" for="apelido">Apelido</label>
                      <input type="text" class="form-control mb-2 mr-sm-4 col-sm-8" name="apelido" placeholder="Como gostaria de ser chamado?" required>

                      <input type="text"   value="n" hidden  name="ativo">                                

                      <button type="submit" class="btn btn-outline-success mb-2 mr-sm-2">Cadastrar</button>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>                   
                  </div>
                </div>
              </div>
            </div>

    <!-- Search Area Starts -->
    <div class="search-area">
        <div class="search-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="listar/procurarrota" method="post" class="d-md-flex justify-content-between">
                            <input type="text" name="cep_inicio" data-mask="99999-999" placeholder="Digite o CEP de partida" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Vai digita aqui'" required>
                            <input type="text" name="cep_fim" data-mask="99999-999" placeholder="Digite o CEP de destino" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Vamos levar para voçê'" required>
                             <input type="text" placeholder="Digite a Data de envio" name="data_inicio" data-mask="99/99/9999" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Pode ser hoje mesmo!'">
                           
                           
                            <button type="submit" class="template-btn">Pesquisar</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Search Area End -->
        <script type="text/javascript">
             $('#cadastro').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) // Button that triggered the modal
              var recipient = button.data('whatever') // Extract info from data-* attributes
              // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
              // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
              var modal = $(this)
              modal.find('.modal-title').text('New message to ' + recipient)
              modal.find('.modal-body input').val(recipient)
            });            
        </script>
       