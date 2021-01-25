<?php

session_start();
require("../conexao.php");

if( isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario'])==false){

    $idUsuario = $_SESSION['id_usuario'];

    $setor = filter_input(INPUT_POST, 'setor');
    $produto = filter_input(INPUT_POST, 'produto');
    $qtdPatrimonio = filter_input(INPUT_POST, 'qtdPatrimonio');

    $sql = $db->prepare("INSERT INTO patrimonio (produto_idproduto, qtd_patrimonio, setor_idsetor, usuarios_idusuarios) VALUES (:produto, :qtd, :setor, :idUsuario)");
    $sql->bindValue(':setor', $setor);
    $sql->bindValue(':produto', $produto);
    $sql->bindValue(':qtd', $qtdPatrimonio);
    $sql->bindValue(':idUsuario', $idUsuario);
   

    if($sql->execute()){

        echo "<script>alert('Patriimônio Lançado');</script>";
        echo "<script>window.location.href='patrimonio.php'</script>";

    }else{
        echo "erro no cadastro contator o administrador!";
    }

}

?>