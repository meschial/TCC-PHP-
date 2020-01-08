<?php
include "modal.php";
?>
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
        
    <!-- Search Area Starts -->
    <div class="search-area">
        <div class="search-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="listar/procurarrota" method="post" class="d-md-flex justify-content-between">
                            <input type="text" name="cep_inicio" data-mask="99999-999" placeholder="CEP de partida" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Vai digita aqui'" required>
                            <input type="text" name="cep_fim" data-mask="99999-999" placeholder="CEP de destino" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Vamos levar'" required>
                             <input type="text" placeholder="Data de envio" name="data_inicio" data-mask="99/99/9999" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Hoje mesmo!'">                          
                           
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
       