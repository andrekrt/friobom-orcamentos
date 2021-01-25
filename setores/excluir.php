<?php 

session_start();
require("../conexao.php");

if(isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario']) == false){
    $idSetor = filter_input(INPUT_GET, 'idsetor');

    $delete = $db->prepare("DELETE FROM setor WHERE idsetor = :idsetor ");
    $delete->bindValue(':idsetor', $idSetor);
    $delete->execute();

    if($delete){
        echo "<script> alert('Excluído com Sucesso!')</script>";
        echo "<script> window.location.href='setores.php' </script>";
    }else{
        echo "Erro, contatar o adminstrador!";
    }

}else{
    echo "Erro, contatar o adminstrador!";
}

?>