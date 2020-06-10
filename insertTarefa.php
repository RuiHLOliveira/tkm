<?php

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];

$dados = "mysql:host=".'localhost'.";" . "dbname=tkm;" . "charset=utf8mb4";
$pdo = null;
try {
    $pdo = new PDO($dados, "root", "123456", null);
} catch (PDOException $e) {
    echo "<pre>Connection failed: ".$e->getMessage()."</pre>";
}

$sql = "insert into tarefas (nome, descricao, completa) values (:nome, :descricao, :completa);";

$statement = $pdo->prepare($sql);

$statement->bindValue(':nome', $nome, PDO::PARAM_STR);
$statement->bindValue(':descricao', $descricao, PDO::PARAM_STR);
$statement->bindValue(':completa', false, PDO::PARAM_BOOL);

$result = $statement->execute();

if($result == false) {
    echo "<!-- Connection failed: ".var_export($statement->errorInfo(),true)." -->";
    header('Location: ./insertForm.php?error='.'Não foi possível inserir a tarefa!');
    return;
}

header('Location: ./index.php?success='.'Tarefa criada!'); 