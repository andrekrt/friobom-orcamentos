<?php

session_start();
require("../conexao.php");

if( isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario'])==false){

    $idUsuario = $_SESSION['id_usuario'];

    $nomeProduto = filter_input(INPUT_POST, 'produto');
    $categoria = filter_input(INPUT_POST, 'categoria');
    $codBarra = filter_input(INPUT_POST, 'codBarra');

    $consulta = $db->prepare("SELECT * FROM produto_servico WHERE nome_peca_servico = :nomeProduto");
    $consulta->bindValue(':nomeProduto', $nomeProduto);
    $consulta->execute();

    if($consulta->rowCount()>0){
        echo "<script>alert('Esse Produto já está cadastrado!');</script>";
        echo "<script>window.location.href='form-novo-produto.php'</script>";
    }else{
        $sql= $db->prepare("INSERT INTO produto_servico (nome_peca_servico, cod_barra, categoria_idcategoria) VALUES (:nomeProduto, :codBarra, :idCategoria)");
        $sql->bindValue(':nomeProduto', $nomeProduto);
        $sql->bindValue(':codBarra', $codBarra);
        $sql->bindValue(':idCategoria', $categoria);
        $sql->execute();
        if($sql){

            echo "<script>alert('Produto Cadastrado!');</script>";
            echo "<script>window.location.href='produtos.php'</script>";

        }else{
            echo "erro no cadastro contator o administrador!";
        }
    }

}

?>