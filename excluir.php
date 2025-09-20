<?php
    include 'config/conexao.php';

    if(isset($_POST['excluir'])){
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        echo $id;
        $sql = "DELETE FROM tarefas WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
    
    header("Location: index.php");
    exit;
?>