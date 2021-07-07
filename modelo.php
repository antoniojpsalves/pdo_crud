<?php

//-------------- conexão -----------------
try {
    $pdo = new PDO("mysql:dbname=CRUDPDO; host=localhost","root","");
} catch (PDOException $e) {
    echo "Erro com bando de dados: ".$e->getMessage();
} catch (Exception $e) {
    echo "Erro genérico".$e->getMessage();
}

//-------------- INSERT -------------------

//Primeiro método utilizando prepare();

/* 
$res = $pdo->prepare("INSERT INTO pessoa(nome, telefone, email) VALUES (:n , :t, :e)");
$res->bindValue(":n", "Antonio");
$res->bindValue(":t", "22222222");
$res->bindValue(":e", "tonin@teste.com");
$res->execute();


//Segunda forma utilizando query();

$pdo->query("INSERT INTO pessoa( nome, telefone, email) VALUES ('Cebola', '55555', 'onion@onion.colm')");
 */

// -------------- UPDATE e DELETE ----------

//DELETE PREPARE();

/* 
$cmd = $pdo->prepare("DELETE FROM pessoa WHERE id= :id");
$id = 2;
$cmd->bindValue(":id",$id);
$cmd->execute();


//DELETE QUERY()
 
 $cmd = $pdo->query("DELETE FROM pessoa WHERE id = '1'");
 */

// UPDATE PREPARE();

/* 
 $cmd = $pdo->prepare("UPDATE pessoa SET email = :e where id = :id");
 $id = 6;
 $cmd->bindValue(":e", "aoba@ugabuga.com");
 $cmd->bindValue(":id", $id);
 $cmd->execute();
 */


 // UPDATE QUERY();

 /* 
 $cmd = $pdo->query("UPDATE pessoa SET nome = 'Mamute' WHERE id = '8'");
 */


// ----------- SELECT --------------------

// SELECT PREPARE();

$cmd = $pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
$id = 5;
$cmd->bindValue(":id", $id);
$cmd->execute();
$result = $cmd->fetch(PDO::FETCH_ASSOC);

//print_r($result);
 
foreach($result as $key => $value){
    echo "$key : $value"."<br>";
}

