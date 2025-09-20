<?php
include 'config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ordemRecebida = $_POST['ordem'] ?? [];

    $ordemAtual = $pdo->query("SELECT id, OrdemDeApresentacao FROM tarefas")->fetchAll(PDO::FETCH_KEY_PAIR);
    $sql = $pdo->prepare("UPDATE tarefas SET OrdemDeApresentacao = :ordem WHERE id = :id");
    $pdo->beginTransaction();

    foreach($ordemRecebida as $posicao => $id){
        $novaOrdem = $posicao + 1;
        if(!isset($ordemAtual[$id]) || $ordemAtual[$id] != $novaOrdem){
            $sql->execute([
                ':ordem' => -$novaOrdem,
                ':id' => $id
            ]);
        }
    }

    foreach($ordemRecebida as $posicao => $id){
        $novaOrdem = $posicao + 1;
        if(!isset($ordemAtual[$id]) || $ordemAtual[$id] != $novaOrdem){
            $sql->execute([
                ':ordem' => $novaOrdem,
                ':id' => $id
            ]);
        }
    }

    $pdo->commit();

    echo json_encode(['status' => 'sucesso']);
}
?>
