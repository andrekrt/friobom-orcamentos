<?php

session_start();
require("../conexao.php");

if(isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario']) == false){

    $idProduto = filter_input(INPUT_POST, 'idProduto');
    $nomeProduto = filter_input(INPUT_POST, 'nomeProduto');
    $codBarra = filter_input(INPUT_POST, 'codBarras');
    $categoria = filter_input(INPUT_POST, 'categoria');

    $atualiza = $db->prepare("UPDATE produto_servico SET nome_peca_servico = :nomeProduto, cod_barra = :codBarra, categoria_idcategoria = :categoria WHERE idpeca_servico = :idProduto ");
    $atualiza->bindValue(':nomeProduto', $nomeProduto);
    $atualiza->bindValue(':codBarra', $codBarra);
    $atualiza->bindValue(':categoria', $categoria);
    $atualiza->bindValue(':idProduto', $idProduto);
    $atualiza->execute();

    //echo "$idProduto <br>$nomeProduto<br>$codBarra<br>$categoria";

    if($atualiza){
        echo "<script> alert('Atualizado com Sucesso!')</script>";
        echo "<script> window.location.href='produtos.php' </script>";
    }else{
        echo "Erro, contatar o administrador";
    }

}else{
    header("Location:setores.php");
}

?>