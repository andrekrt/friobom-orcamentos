<?php

session_start();
require("../conexao.php");

if(isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario']) == false){

    $idFornecedor = filter_input(INPUT_POST, 'idFornecedor');
    $fornecedor = filter_input(INPUT_POST, 'fornecedor');
    $cnpj = filter_input(INPUT_POST, 'cnpj');
    $endereco = filter_input(INPUT_POST, 'endereco');
    $numEstab = filter_input(INPUT_POST, 'numEstab');
    $bairro = filter_input(INPUT_POST, 'bairro');
    $cidade = filter_input(INPUT_POST, 'cidade');
    $estado = filter_input(INPUT_POST, 'estado');
    $telefone = filter_input(INPUT_POST, 'telefone');

    $atualiza = $db->prepare("UPDATE fornecedor SET nome_fornecedor = :nomeFornecedor, cnpj = :cnpj, endereco = :endereco, num_estab = :numEstab, bairro = :bairro, cidade = :cidade, estado = :estado, telefone = :telefone WHERE idfornecedor = :idFornecedor ");
    $atualiza->bindValue(':nomeFornecedor', $fornecedor);
    $atualiza->bindValue(':cnpj', $cnpj);
    $atualiza->bindValue(':endereco', $endereco);
    $atualiza->bindValue(':numEstab', $numEstab);
    $atualiza->bindValue(':bairro', $bairro);
    $atualiza->bindValue(':cidade', $cidade);
    $atualiza->bindValue(':estado', $estado);
    $atualiza->bindValue(':telefone', $telefone);
    $atualiza->bindValue(':idFornecedor', $idFornecedor);
    $atualiza->execute();

    //echo "$idProduto <br>$nomeProduto<br>$codBarra<br>$categoria";

    if($atualiza){
        echo "<script> alert('Atualizado com Sucesso!')</script>";
        echo "<script> window.location.href='fornecedores.php' </script>";
    }else{
        echo "Erro, contatar o administrador";
    }

}else{
    header("Location:setores.php");
}

?>