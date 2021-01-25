<?php

session_start();
require("../conexao.php");

if(isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario']) == false){

    $idCategoria = filter_input(INPUT_POST, 'idcategoria');
    $nomeCategoria = filter_input(INPUT_POST, 'nome_categoria');

    $atualiza = $db->prepare("UPDATE categoria SET nome_categoria = :nomeCategoria WHERE idcategoria = :idCategoria ");
    $atualiza->bindValue(':nomeCategoria', $nomeCategoria);
    $atualiza->bindValue(':idCategoria', $idCategoria);
    $atualiza->execute();

    //echo "$idCategoria <br>$nomeCategoria<br>";

    if($atualiza){
        echo "<script> alert('Atualizado com Sucesso!')</script>";
        echo "<script> window.location.href='categorias.php' </script>";
    }else{
        echo "Erro, contatar o administrador";
    }

}else{
    header("Location:cateogiras.php");
}

?>