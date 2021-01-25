<?php 

session_start();
require("../conexao.php");

if(isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario']) == false){
    $idPatrimonio = filter_input(INPUT_GET, 'idPatrimonio');

    $delete = $db->prepare("DELETE FROM patrimonio WHERE idpatrimonio = :idpatrimonio");
    $delete->bindValue(':idpatrimonio', $idPatrimonio);
    $delete->execute();

    if($delete){
        echo "<script> alert('Excluído com Sucesso!')</script>";
        echo "<script> window.location.href='patrimonio.php' </script>";
    }else{
        echo "Erro, contatar o adminstrador!";
    }

}else{
    echo "Erro, contatar o adminstrador!";
}

?>