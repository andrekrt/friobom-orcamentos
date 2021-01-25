<?php

session_start();
require("../conexao.php");

if( isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario'])==false){

    $idUsuario = $_SESSION['id_usuario'];

    $nomeSetor = filter_input(INPUT_POST, 'setor');

    $consulta = $db->prepare("SELECT * FROM setor WHERE nome_setor = :nomeSetor");
    $consulta->bindValue(':nomeSetor', $nomeSetor);
    $consulta->execute();

    if($consulta->rowCount()>0){
        echo "<script>alert('Esse Setor já está cadastrado!');</script>";
        echo "<script>window.location.href='form-novo-setor.php'</script>";
    }else{
        $sql= $db->prepare("INSERT INTO setor (nome_setor) VALUES (:setor)");
        $sql->bindValue(':setor', $nomeSetor);
        $sql->execute();
        if($sql){

            echo "<script>alert('Setor Cadastrado!');</script>";
            echo "<script>window.location.href='setores.php'</script>";

        }else{
            echo "erro no cadastro contator o administrador!";
        }
    }

}

?>