<?php

try {
    $pdo = new PDO("mysql:dbname=jeff; host=localhost", "root", "");
} catch (PDOException $e) {
    echo "Erro ao conectar com o banco de dados: ".$e->getMessage();
} catch (Exception $e) {
    echo "Erro genérico: ".$e->getMessage();
}


// INSERT

/* $cmd = $pdo->prepare("INSERT INTO PESSOA (nome, email, senha) VALUES (:n, :e, :s)");

$nome = "Natasha Oliveira Alves";
$email = "princess_nat@gmail.com";
$senha = "asdasda";

$cmd->bindValue(":n", $nome);
$cmd->bindValue(":e", $email);
$cmd->bindValue(":s", $senha);

$cmd->execute(); */

// DELETE

/* 
$cmd = $pdo->prepare("DELETE FROM PESSOA WHERE ID = :id");
$id = 1;
$cmd->bindValue(":id", $id);
$cmd->execute(); */


// update

/* $cmd = $pdo->prepare("UPDATE PESSOA SET email = :e  WHERE id = :id");
$cmd->bindValue(":e", "murilo@gmail.com");
$cmd->bindValue(":id", 2);
$cmd->execute();

 */

 // SELECT

 $cmd = $pdo->prepare("SELECT * FROM PESSOA WHERE ID = :id");
 $cmd->bindValue(":id", 3);
 $cmd->execute();

$res = $cmd->fetch(PDO::FETCH_ASSOC);

foreach ($res as $key => $value) {
    echo "$key :  $value"."<br>";
}