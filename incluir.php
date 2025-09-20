<?php
    session_start();
    include 'config/conexao.php';

    if(isset($_POST['incluir'])){
        $nomeDaTarefa = filter_input(INPUT_POST, 'nomeDaTarefa', FILTER_SANITIZE_SPECIAL_CHARS);
        $custo = filter_input(INPUT_POST, 'custo', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $dataLimite = filter_input(INPUT_POST, 'dataLimite', FILTER_SANITIZE_SPECIAL_CHARS);
        $ordemDeApresentacao = filter_input(INPUT_POST, 'ordemDeApresentacao', FILTER_SANITIZE_NUMBER_INT);
        $stmt = $pdo->prepare("SELECT NomeDaTarefa FROM tarefas WHERE NomeDaTarefa = :nome");
        $stmt->execute([':nome' => $nomeDaTarefa]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['mensagem'] = "Tarefa \"$nomeDaTarefa\" já existe e foi encontrada!";
        }else{
            $totaldeTarefas = $pdo->query("SELECT id FROM tarefas")->rowCount();
            $sql = "INSERT INTO tarefas (NomeDaTarefa, Custo, DataLimite, OrdemDeApresentacao) 
                VALUES (:nome, :custo, :data, :ordem)";
            $stmt = $pdo->prepare($sql);
            
            $stmt->execute([
                ':nome'  => $nomeDaTarefa,
                ':custo' => $custo,
                ':data'  => $dataLimite,
                ':ordem' => $totaldeTarefas+1
            ]); 
        }       
    }

    header("Location: index.php");
    exit;
?>