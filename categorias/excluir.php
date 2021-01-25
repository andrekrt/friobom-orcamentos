<?php 

session_start();
require("../conexao.php");

if(isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario']) == false){
    $idCategoria = filter_input(INPUT_GET, 'idcategoria');

    $delete = $db->prepare("DELETE FROM categoria WHERE idcategoria = :idCategoria ");
    $delete->bindValue(':idCategoria', $idCategoria);
    $delete->execute();

    if($delete){
        echo "<script> alert('Excluído com Sucesso!')</script>";
        echo "<script> window.location.href='categorias.php' </script>";
    }else{
        echo "Erro, contatar o adminstrador!";
    }

}else{
    echo "Erro, contatar o adminstrador!";
}

?>