<?php 

session_start();
require("../conexao.php");

if(isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario']) == false){
    $idLancamento = filter_input(INPUT_GET, 'idLancamento');

    $delete = $db->prepare("DELETE FROM lancamento WHERE idlancamento = :idlancamento");
    $delete->bindValue(':idlancamento', $idLancamento);
    $delete->execute();

    if($delete){
        echo "<script> alert('Excluído com Sucesso!')</script>";
        echo "<script> window.location.href='despesas.php' </script>";
    }else{
        echo "Erro, contatar o adminstrador!";
    }

}else{
    echo "Erro, contatar o adminstrador!";
}

?>