<?php 

session_start();
require("../conexao.php");

if(isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario']) == false){
    $idProduto = filter_input(INPUT_GET, 'idProduto');

    $delete = $db->prepare("DELETE FROM produto_servico WHERE idpeca_servico = :idProduto ");
    $delete->bindValue(':idProduto', $idProduto);
    $delete->execute();

    if($delete){
        echo "<script> alert('Excluído com Sucesso!')</script>";
        echo "<script> window.location.href='produtos.php' </script>";
    }else{
        echo "Erro, contatar o adminstrador!";
    }

}else{
    echo "Erro, contatar o adminstrador!";
}

?>