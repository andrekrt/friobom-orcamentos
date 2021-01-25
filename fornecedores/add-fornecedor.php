<?php

session_start();
require("../conexao.php");

if( isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario'])==false){

    $idUsuario = $_SESSION['id_usuario'];

    $nomeFornecedor = filter_input(INPUT_POST, 'fornecedor');
    $cnpj = filter_input(INPUT_POST, 'cnpj');
    $telefone = filter_input(INPUT_POST, 'telefone');
    $endereco = filter_input(INPUT_POST, 'endereco');
    $numEstab = filter_input(INPUT_POST, 'numEstab');
    $bairro = filter_input(INPUT_POST, 'bairro');
    $cidade = filter_input(INPUT_POST, 'cidade');
    $estado = filter_input(INPUT_POST, 'estado');

    $consulta = $db->prepare("SELECT * FROM fornecedor WHERE nome_fornecedor = :nomeFornecedor");
    $consulta->bindValue(':nomeFornecedor', $nomeFornecedor);
    $consulta->execute();

    if($consulta->rowCount()>0){
        echo "<script>alert('Esse Fornecedor já está cadastrado!');</script>";
        echo "<script>window.location.href='form-novo-fornecedor.php'</script>";
    }else{
        $sql= $db->prepare("INSERT INTO fornecedor (nome_fornecedor, cnpj, endereco, num_estab, bairro, cidade, estado, telefone) VALUES (:nomeFornecedor, :cnpj, :endereco, :numEstab, :bairro, :cidade, :estado, :telefone)");
        $sql->bindValue(':nomeFornecedor', $nomeFornecedor);
        $sql->bindValue(':cnpj', $cnpj);
        $sql->bindValue(':endereco', $endereco);
        $sql->bindValue(':numEstab', $numEstab);
        $sql->bindValue(':bairro', $bairro);
        $sql->bindValue(':cidade', $cidade);
        $sql->bindValue(':estado', $estado);
        $sql->bindValue(':telefone', $telefone);
        $sql->execute();
       if($sql){

            echo "<script>alert('Fornecedor Cadastrado!');</script>";
            echo "<script>window.location.href='fornecedores.php'</script>";

        }else{
            echo "erro no cadastro contator o administrador!";
        }
    }

}

?>