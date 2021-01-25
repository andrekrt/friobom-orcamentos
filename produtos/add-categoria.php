<?php

session_start();
require("../conexao.php");

if( isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario'])==false){

    $idUsuario = $_SESSION['id_usuario'];

    $nomeCategoria = filter_input(INPUT_POST, 'categoria');

    $consulta = $db->prepare("SELECT * FROM categoria WHERE nome_categoria = :nomeCategoria");
    $consulta->bindValue(':nomeCategoria', $nomeCategoria);
    $consulta->execute();

    if($consulta->rowCount()>0){
        echo "<script>alert('Essa Categoria já está cadastrado!');</script>";
        echo "<script>window.location.href='form-nova-categoria.php'</script>";
    }else{
        $sql= $db->prepare("INSERT INTO categoria (nome_categoria) VALUES (:nomeCategoria)");
        $sql->bindValue(':nomeCategoria', $nomeCategoria);
        $sql->execute();
        if($sql){

            echo "<script>alert('Categoria Cadastrada!');</script>";
            echo "<script>window.location.href='form-novo-produto.php'</script>";

        }else{
            echo "erro no cadastro contator o administrador!";
        }
    }

}

?>