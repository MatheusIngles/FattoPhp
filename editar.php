<?php
    include 'config/conexao.php';

    if(isset($_POST['editar'])){
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $nomeDaTarefa = filter_input(INPUT_POST, 'NomeDaTarefa', FILTER_SANITIZE_SPECIAL_CHARS);
        $custo = filter_input(INPUT_POST, 'Custo', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $dataLimite = filter_input(INPUT_POST, 'DataLimite', FILTER_SANITIZE_SPECIAL_CHARS);
        $sql = "UPDATE tarefas SET NomeDaTarefa = :nome, Custo = :custo, DataLimite = :data WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':nome' => $nomeDaTarefa, ':custo' => $custo, ':data' => $dataLimite, ':id' => $id]);
    }
    
    header("Location: index.php");
    exit;
?>