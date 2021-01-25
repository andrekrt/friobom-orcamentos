<?php 

session_start();
require("../conexao.php");

if(isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario']) == false){
    $idFornecedor = filter_input(INPUT_GET, 'idFornecedor');

    $delete = $db->prepare("DELETE FROM fornecedor WHERE idfornecedor = :idFornecedor ");
    $delete->bindValue(':idFornecedor', $idFornecedor);
    $delete->execute();

    if($delete){
        echo "<script> alert('Excluído com Sucesso!')</script>";
        echo "<script> window.location.href='fornecedores.php' </script>";
    }else{
        echo "Erro, contatar o adminstrador!";
    }

}else{
    echo "Erro, contatar o adminstrador!";
}

?>