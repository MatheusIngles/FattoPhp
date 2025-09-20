<?php
session_start();

if(isset($_SESSION['mensagem'])){
    echo "<script>alert('{$_SESSION['mensagem']}');</script>";
    unset($_SESSION['mensagem']); // limpa a mensagem após exibir
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Lista de Tarefas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="static/css/index.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
</head>
<body>
  <div class="container">
    <h2 class="text-center mb-4">📋 Lista de Tarefas</h2>

    <table class="table table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th></th>
          <th></th>
          <th>Nome</th>
          <th>Custo (R$)</th>
          <th>Data Limite</th>
          <th class="text-center">Ações</th>
        </tr>
      </thead>
      <tbody id="tabela-tarefas">
        <?php
            include 'config/conexao.php';

            $stmt = $pdo->prepare("SELECT id,NomeDaTarefa, Custo, DataLimite FROM tarefas ORDER BY OrdemDeApresentacao ASC");
            $stmt->execute();
            $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($tarefas as $tarefa) {
                if($tarefa['Custo'] < 1000) {
                    echo '<tr data-id="'.$tarefa['id'].'">
                            <td class="text-center drag-handle"><i class="fa fa-grip-lines"></i></td>
                            <td type="hidden">'.$tarefa['id'].'</td>
                            <td>'.$tarefa['NomeDaTarefa'].'</td>
                            <td>'.$tarefa['Custo'].'</td>
                            <td>'.$tarefa['DataLimite'].'</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditar" data-id="'.$tarefa['id'].'" data-nome="'.$tarefa['NomeDaTarefa'].'" data-custo="'.$tarefa['Custo'].'" data-data="'.$tarefa['DataLimite'].'"><i class="fa fa-pen"></i></button>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalExcluir" data-id="'.$tarefa['id'].'" data-nome="'.$tarefa['NomeDaTarefa'].'"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>';
                } else {
                    echo '<tr class="tarefa-cara" data-id="'.$tarefa['id'].'">
                            <td class="text-center drag-handle"><i class="fa fa-grip-lines"></i></td>
                            <td type="hidden">'.$tarefa['id'].'</td>
                            <td>'.$tarefa['NomeDaTarefa'].'</td>
                            <td>'.$tarefa['Custo'].'</td>
                            <td>'.$tarefa['DataLimite'].'</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditar" data-id="'.$tarefa['id'].'" data-nome="'.$tarefa['NomeDaTarefa'].'" data-custo="'.$tarefa['Custo'].'" data-data="'.$tarefa['DataLimite'].'"><i class="fa fa-pen"></i></button>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalExcluir" data-id="'.$tarefa['id'].'" data-nome="'.$tarefa['NomeDaTarefa'].'"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>';
                }
            }
        ?>
      </tbody>
    </table>

    <div class="text-end">
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalIncluir">
        <i class="fa fa-plus"></i> Incluir Tarefa
      </button>
      <button class="btn btn-primary" onclick="salvarOrdem()" id="btnSalvarOrdem">
        <i class="fa fa-save"></i> Salvar Ordem
      </button>
    </div>
  </div>

  <div class="modal fade" id="modalIncluir" tabindex="-1">
    <div class="modal-dialog">
      <form class="modal-content" action="incluir.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Incluir Tarefa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nome da Tarefa</label>
            <input type="text" name="nomeDaTarefa" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Custo (R$)</label>
            <input type="number" name="custo" class="form-control" step="0.01" min="0" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Data Limite</label>
            <input type="date" name="dataLimite" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" name="incluir" class="btn btn-success">Salvar</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modalEditar" tabindex="-1">
    <div class="modal-dialog">
      <form class="modal-content" action="editar.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Editar Tarefa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="id">
          <div class="mb-3">
            <label class="form-label">Nome da Tarefa</label>
            <input type="text" class="form-control" name="NomeDaTarefa"  value="" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Custo (R$)</label>
            <input type="number" class="form-control" name="Custo" step="0.01" min="0" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Data Limite</label>
            <input type="date" class="form-control" name="DataLimite" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" name="editar" class="btn btn-primary">Atualizar</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modalExcluir" tabindex="-1">
    <div class="modal-dialog">
      <form class="modal-content" action="excluir.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Confirmar Exclusão</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p>Tem certeza que deseja excluir a tarefa <strong id="tarefaNome"></strong>?</p>
          <input type="hidden" name="id" id="tarefaId">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
          <button type="submit" name="excluir" class="btn btn-danger">Sim, excluir</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="static/js/index.js"></script>
</body>
</html>
