<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- {{-- jquery and bootstrap --}} -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/886bf3cc12.js" crossorigin="anonymous"></script>
</head>
<body class="container">

<?php
    $dados = "mysql:host=localhost;dbname=tkm;charset=utf8mb4";
    $pdo = null;
    try {
        $pdo = new PDO($dados, "root", "123456", null);
    } catch (PDOException $e) {
        echo "<pre>Connection failed:".$e->getMessage()."</pre>";
    }

    $sql = "select * from tarefas;";

    $statement = $pdo->prepare($sql);

    $result = $statement -> execute();

    if($result == false){
        echo "<pre> Connection failed: ".var_export($statement->errorInfo(), true)."</pre>";
        // header('Location: ./index.php?error='.'Não foi possível a tarefa!');
        return;
    }

    $tarefas = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Lista de Tarefas</h1>
<h4>Sua lista de tarefas aqui!</h4>
<hr>
<a class="btn btn-primary" href="./insertForm.php">Cadastrar</a>
<br>
<br>
<?php
    if(isset($_GET['success'])){
        echo "<div class='alert alert-success' role='alert'>".$_GET['success']."</div>";
    }
?>

<?php

foreach ($tarefas as $key => $tarefa) {
    echo $tarefa['nome'].' - '.$tarefa['descricao'].'<br>';
}

?>

</body>
</html>