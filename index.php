<?php
    require_once 'classe-pessoa.php';

    $p = new Pessoa("crudpdo", "localhost", "root", "");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PDO lessons</title>
</head>
<body>
    
    <?php 
        if(isset($_POST['nome'])) { //clicou no botão cadastrar ou atualizar

            if(isset($_GET['id_up']) && !empty($_GET['id_up'])) { // Atualizar informação

                $id_upd = addslashes($_GET['id_up']);
                $nome = addslashes($_POST['nome']);
                $telefone = addslashes($_POST['telefone']);
                $email = addslashes($_POST['email']);
    
                if (!empty($nome) && !empty($telefone) && !empty($email)) {
    
                    //Atualiar dados
                    $p->atualizarDados($id_upd, $nome, $telefone, $email);

                    header("location:index.php");
                    exit();
    
                } else {
                    ?>
                        <div class='aviso'><h4>Preencha todos os campos!</h4></div>";
                    <?php
                }

            } else { //Cadastrar

                $nome = addslashes($_POST['nome']);
                $telefone = addslashes($_POST['telefone']);
                $email = addslashes($_POST['email']);
    
                if (!empty($nome) && !empty($telefone) && !empty($email)) {
    
                    //cadastrar
                    if(!$p->cadastrarPessoa($nome, $telefone, $email)) {
                        ?>
                            <div class='aviso'><h4>Email já cadastrado!</h4></div>
                        <?php
                    }
    
                } else {
                    ?>
                        <div class='aviso'><h4>Preencha todos os campos!</h4></div>
                    <?php
                }

            }

        }
    ?>


    <?php 
    
        if(isset($_GET['id_up'])) {

            $id_update = addslashes($_GET['id_up']);
            $res_dados = $p->buscarDadosPessoa($id_update);
            /*header("location: index.php");
            exit(); */

        }    

    ?>
    <section id="esquerda">
        <form method="POST">
            <h2>Cadastrar Pessoa</h2>
            <label for="nome">Nome: </label>
            <input type="text" name="nome" id="nome" value="<?php if(isset($res_dados)) { echo $res_dados['nome'];}?>">
            <label for="telefone">Telefone: </label>
            <input type="text" name="telefone" id="telefone" value="<?php if(isset($res_dados)) { echo $res_dados['telefone'];}?>">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php if(isset($res_dados)) { echo $res_dados['email'];}?>">
            <input type="submit" value="<?php if(isset($res_dados)) {echo "Atualizar";} else { echo "Cadastrar";}?>">
        </form>
    </section>
    <section id="direita">

    <table>
            <tr id="titulo">
                <td>NOME</td>
                <td>TELEFONE</td>
                <td colspan="2">EMAIL</td>
            </tr>

            <?php
                $dados = $p->buscarDados();
                /* echo "<pre>";
                var_dump($dados);
                echo"</pre>"; */

                if(count($dados) > 0) {

                    for($i = 0; $i < count($dados); $i ++) {

                        echo "<tr>";

                        foreach($dados[$i] as $k => $v){

                            if($k != "id"){

                                echo "<td>".$v."</td>";

                            }
                        }

                        ?>
                        <td><a href="index.php?id_up=<?php echo $dados[$i]['id'];?>">Editar</a> 
                        <a href="index.php?id=<?php echo $dados[$i]['id'];?>">Excluir</a></td>
                        <?php

                        echo "</tr>";

                    }

                } else {
                    ?>
                        <div class='aviso'><h4>Ainda não há pessoas cadastradas!</h4></div>
                    <?php
                }

            ?>
        </table>
    </section>
</body>
</html>


<?php 

    if(isset($_GET['id'])){
        
        $id_pessoa = addslashes($_GET['id']);
        $p->excluirPessoa($id_pessoa);
        header("location: index.php");
        exit();
    }

?>
