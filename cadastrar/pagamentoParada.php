        <?php
        $apelido = $_SESSION["tcc"]["apelido"];
         if ( isset ( $p[2] ) ) {
            $id_item = (int)$p[2];

          //selecionar os dados do editora
          $sql = "select date_format(rota.data_inicio, '%d/%m/%Y') data_inicio, item.id, produto.nome, sum(produto.quantidade) as total, rota.cidade_fim, parada.cep, parada.valor, parada.cidade from produto 
          inner join item on produto.item_id = item.id
          inner join parada on item.parada_id = parada.id
          right join rota on parada.rota_id = rota.id
          where produto.item_id = $id_item";
          $consulta = $pdo->prepare($sql);
          $consulta->execute();
        }
          //laço de repetição para separar as linhas
          while ( $linha = $consulta->fetch(PDO::FETCH_OBJ)) {
            //separar os dados
            $id                = $linha->id;           
            $cidade    = $linha->cidade;
            $cidade_fim        = $linha->cidade_fim;
            $data              = $linha->data_inicio;
            $quantidade        = $linha->total;
            $valor             = $linha->valor;
            
            $resultado = $quantidade * $valor;

            $resultado = number_format($resultado, 2, ",", ".");
           }
                     
        ?>
  <div class="container">
    <form method="post" action="salvar/venda">
      <div class="form-row">
            <div class="form-group col-md-3">
              <label for="item_id">ID Item:</label>
              <input  name="item_id" type="text"  value="<?=$id;?>" readonly class="form-control">
            </div>
            <div class="form-group col-md-3">
              <label for="Cliente">Cliente:</label>
              <input type="text"  value="<?=$apelido;?>" readonly class="form-control">
            </div>        
            <div class="form-group col-md-3">
          <label for="data">Data Partida:</label>
          <input type="text"  value="<?=$data;?>" required class="form-control">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-3">
            <label for="cidade_inicio">Cidade Partida:</label>
            <input  type="text"  value="<?=$cidade;?>" readonly class="form-control">
        </div>
        <div class="form-group col-md-3">
          <label for="cidade_fim">Cidade Destino</label>
          <input  type="text"  value="<?=$cidade_fim;?>" required class="form-control">
        </div>
        
      </div>

      <div class="form-row">       
        
        <div class="form-group col-md-3">
          <label for="quantidade">Quantidade de Produtos</label>
          <input type="text"  value="<?=$quantidade;?>" required class="form-control">
        </div>      
        <div class="form-group col-md-3">
          <label for="resultado">Valor Total:</label>
          <input  type="text" name="valor"  value="<?=$resultado;?>" required class="form-control">
        </div>          
         
    </div> 
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>