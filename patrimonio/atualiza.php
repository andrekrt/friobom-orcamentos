<?php

session_start();
require("../conexao.php");

if(isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario']) == false){

    $idpatrimonio = filter_input(INPUT_POST, 'idPatrimonio');
    $setor = filter_input(INPUT_POST, 'setor');
    $produto = filter_input(INPUT_POST, 'produto');
    $qtdPatrimonio = filter_input(INPUT_POST, 'qtdPatrimonio');

    $atualiza = $db->prepare("UPDATE patrimonio SET setor_idsetor = :setor, produto_idproduto = :produto, qtd_patrimonio = :qtdPatrimonio WHERE idpatrimonio = :idPatrimonio ");
    $atualiza->bindValue(':setor', $setor);
    $atualiza->bindValue(':produto', $produto);
    $atualiza->bindValue(':qtdPatrimonio', $qtdPatrimonio);
    $atualiza->bindValue(':idPatrimonio', $idpatrimonio);
    $atualiza->execute();

    //print_r($atualiza->errorInfo());

    //echo "$idProduto <br>$nomeProduto<br>$codBarra<br>$categoria";

    if($atualiza){
        echo "<script> alert('Atualizado com Sucesso!')</script>";
        echo "<script> window.location.href='patrimonio.php' </script>";
    }else{
        echo "Erro, contatar o administrador";
    }

}else{
    header("Location:patrimonio.php");
}

?>