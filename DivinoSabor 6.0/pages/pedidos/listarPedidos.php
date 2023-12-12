<?php

include_once './config/constantes.php';
include_once './config/conexao.php';
include_once './func/dashboard.php';

?>

<h1 style="text-align: center;">Pedidos</h1>


<button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalCadPedido">
  <i class="fa-solid fa-plus"></i> Cadastrar Pedido
</button>
<a href="./gerarRelatorios/gerarRelatPedido.php"><button type="button" class="btn btn-outline-secondary"> <i class="fa-solid fa-print"></i>
    Gerar Relatório Geral
  </button> </a>
<br><br>



<div style="height: 400px;">
  <table class="table-financeira table table-hover">
    <thead>
      <tr>
        <th scope="col" width="5%">Código</th>
        <th scope="col" width="25%">Nome</th>
        <th scope="col" width="15%">Pedido</th>
        <th scope="col" width="30%">Detalhes</th>
        <th scope="col" width="30%">Data de Entrega</th>
        <th scope="col" width="25%">Ações</th>
      </tr>
    </thead>
    <tbody>

      <?php
      $dataAtual = date("Y-m-d");  // Formato ISO 8601!!!!!!
      $dataSeteDiasAntes = date("Y-m-d", strtotime("-7 days"));


      $retornoListarPedidos = listarGeral('idpedidos, nome, pedido, detalhes, cadastro, alteracao, ativo, dataEntrega', 'pedidos');
      if (is_array($retornoListarPedidos) && !empty($retornoListarPedidos)) {
        foreach ($retornoListarPedidos as $itemPedido) {
          $idPedido = $itemPedido->idpedidos;
          $nomePedido = $itemPedido->nome;
          $pedido = $itemPedido->pedido;
          $detalhesPedido = $itemPedido->detalhes;
          $ativoPedido = $itemPedido->ativo;
          $dataEntrega = $itemPedido->dataEntrega;

          $dataEntregaFormat = date("d/m/Y", strtotime($dataEntrega)); //passando para o formato br

          $classeData = '';
          if (strtotime($dataAtual) >= strtotime($dataEntrega)) {
            $classeData = 'entregaVermelha';
          } elseif (strtotime($dataAtual) >= strtotime('-7 days', strtotime($dataEntrega)) && strtotime($dataAtual) < strtotime($dataEntrega)) {
            $classeData = 'entregaAmarela';
          } else {
            $classeData = 'entregaVerde';
          }




      ?>

          <tr>
            <th scope="row"><?php echo $idPedido; ?></th>
            <td><?php echo $nomePedido; ?></td>
            <td><?php echo $pedido; ?></td>
            <td><?php echo $detalhesPedido; ?></td>
            <td class="<?php echo $classeData; ?>"><?php echo $dataEntregaFormat; ?></td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <?php
                if ($ativoPedido == 'A') {
                ?>
                  <button type='button' class='btn btn-outline-dark' onclick="ativarGeral(<?php echo $idPedido; ?>,'desativar','ativarPedidos','listarPedidos', 'Pedido marcado como concluído');"> <i class="fa-solid fa-unlock"></i> Não Concluído</button>
                <?php
                } else {
                ?>
                  <button type='button' class='btn btn-outline-success' onclick="ativarGeral(<?php echo $idPedido; ?>, 'ativar', 'ativarPedidos','listarPedidos', 'Pedido marcado como não concluído');"><i class="fa-solid fa-lock"></i> Concluído</button>

                <?php
                }
                ?>

                <!-- passando id diretamente na URL - sem SEM AJAX -->
                <a href="./gerarRelatorios/gerarRelatUnPedido.php?id=<?php echo $idPedido; ?>" target="_blank">
                  <button type="button" class="btn btn-outline-info">
                    <i class="fa-solid fa-print"></i> Relatório
                  </button>
                </a>




                <button type="submit" class="btn btn-outline-danger" onclick="excGeral('<?php echo $idPedido; ?>', 'excluirPedidos', 'listarPedidos', 'Certeza que deseja excluir?', 'Operação Irreversível!')"><i class="fa-solid fa-trash"></i> Excluir</button>
              </div>
            </td>
          </tr>
      <?php
        }
      } else {
        echo "<div class='alert alert-warning' style='text-align: center;' role='alert'>";
        echo "Nenhum Registro Encontrado";
        echo "</div>";
      }
      ?>

    </tbody>
  </table>
</div>


<style>
  .entregaVermelha,
  .entregaAmarela,
  .entregaVerde {
    border-radius: 10px;
    padding: 15px 30px;
    color: #fff;
    font-weight: bold;
    text-align: center;
    display: inline-block;
    margin: 10px;
    cursor: pointer;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    position: relative;
    z-index: 0;
  }

  .entregaVermelha {
    background: linear-gradient(45deg, #FF6347, #FF4580);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .entregaAmarela {
    background: linear-gradient(45deg, #FFD700, #FFA500);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .entregaVerde {
    background: linear-gradient(45deg, #32CD32, #008000);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  /* Hover effect */
  .entregaVermelha:hover,
  .entregaAmarela:hover,
  .entregaVerde:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
  }
</style>




<div class="modal fade" id="modalCadPedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:blueviolet; color: white;">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Pedido</h5>
      </div>
      <form name="frmCadPedido" method="POST" id="frmCadPedido" class="frmCadPedido" action="#">
        <div class="modal-body">
          <div class="mb-3">
            <label for="nomePedido" class="form-label">Nome do Cliente</label>
            <input type="text" class="form-control" name="nomePedido" id="nomePedido" aria-describedby="nomePedido" required>
          </div>
          <div class="mb-3">
            <label for="pedido" class="form-label">Pedido</label>
            <input type="text" class="form-control" name="pedido" id="pedido" required>
          </div>
          <div class="mb-3">
            <label for="detalhesPedido" class="form-label">Detalhes</label>
            <textarea class="form-control" name="detalhesPedido" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="dataEntregaPedido" class="form-label">Data de Entrega</label>
            <input type="date" class="form-control" name="dataEntregaPedido" id="dataEntregaPedido" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary" onclick="cadGeral('frmCadPedido','modalCadPedido','cadastrarPedidos','listarPedidos');">Cadastrar</button>
        </div>
      </form>
    </div>
  </div>
</div>