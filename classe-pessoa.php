<?php

class Pessoa {

    private $pdo;
    //6 funções

    //conexão com o banco de dados
    public function __construct($dbname, $host, $user, $password) {

        try {
            $this->pdo = new PDO("mysql:dbname=".$dbname."; host=".$host, $user, $password);
        } catch (PDOException $e) {
            echo "Erro ao conectar com o banco de dados: ".$e->getMessage();
            exit();
        } catch (Exception $e) {
            echo "Erro genérico: ".$e->getMessage();
            exit();
        }
    }

    //BUCAR OS DADOS E RETORNAR UM ARRAY PARA SER EXIBIDO NO CANTO DIREITO DA TELA.
    public function buscarDados() {
        $res = array();
        $cmd = $this->pdo->query("SELECT * FROM PESSOA ORDER BY nome");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    // Função de cadastrar pessoas no banco de dados
    public function cadastrarPessoa($nome, $telefone, $email) {
        
        //Verificando se o email já foi cadatrado antes

        $cmd = $this->pdo->prepare("SELECT * FROM PESSOA WHERE email = :e");
        $cmd->bindValue(":e", $email);
        $cmd->execute();

        if ($cmd->rowCount() > 0) { // Se houver um registro o retorno será 1.

            return false;

        } else {    // Se não houver registro o cadastro é realizado.

            $cmd = $this->pdo->prepare("INSERT INTO PESSOA (nome, telefone, email) VALUES (:n, :t, :e)");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":t", $telefone);
            $cmd->bindValue(":e", $email);

            $cmd->execute();

            return true;

        }

    }


    //Excluir um registro do banco
    public function excluirPessoa($id) {

        $cmd = $this->pdo->prepare("DELETE FROM PESSOA WHERE ID = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
    }

    //Pesquisar por uma pessoa específica
    public function buscarDadosPessoa($id){

        $res = array();

        $cmd = $this->pdo->prepare("SELECT * FROM PESSOA WHERE ID = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();

        $res = $cmd->fetch(PDO::FETCH_ASSOC);

        return $res;

    }



    //Atualizar dados no banco

    public function atualizarDados($id, $nome, $telefone, $email) {

        $cmd = $this->pdo->prepare("UPDATE PESSOA SET nome = :n, telefone = :t, email = :e WHERE id = :id");
        $cmd->bindValue(":n", $nome);
        $cmd->bindValue(":t", $telefone);
        $cmd->bindValue(":e", $email);
        $cmd->bindValue(":id", $id);
        $cmd->execute();
    }



}

?>