<?php

session_start();
require("../conexao.php");

if(isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario']) == false){

    $idSetor = filter_input(INPUT_POST, 'idsetor');
    $nomeSetor = filter_input(INPUT_POST, 'nome_setor');

    $atualiza = $db->prepare("UPDATE setor SET nome_setor = :nomeSetor WHERE idsetor = :idsetor ");
    $atualiza->bindValue(':nomeSetor', $nomeSetor);
    $atualiza->bindValue(':idsetor', $idSetor);
    $atualiza->execute();

    //echo "$codVeiculo <br>$tipoVeiculo<br>$placa";

    if($atualiza){
        echo "<script> alert('Atualizado com Sucesso!')</script>";
        echo "<script> window.location.href='setores.php' </script>";
    }else{
        echo "Erro, contatar o administrador";
    }

}else{
    header("Location:setores.php");
}

?>