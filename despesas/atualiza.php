<?php

session_start();
require("../conexao.php");

if(isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario']) == false){

    $idlancamento = filter_input(INPUT_POST, 'idLancamento');
    $fornecedor = filter_input(INPUT_POST, 'fornecedor');
    $setor = filter_input(INPUT_POST, 'setor');
    $produto = filter_input(INPUT_POST, 'produto');
    $codFabrica = filter_input(INPUT_POST, 'codFabrica');
    $valorUnit = str_replace(",", ".", filter_input(INPUT_POST, 'vlUn')) ;
    $qtd = str_replace(",", ".",filter_input(INPUT_POST, 'qtd')) ;
    $valorTotal = $valorUnit*$qtd;
    $obsOrcamento = filter_input(INPUT_POST, 'obsOrcamento');
    $obsAnalise = filter_input(INPUT_POST, 'obsAnalise');
    $situacao = filter_input(INPUT_POST, 'situacao')?filter_input(INPUT_POST, 'situacao'):"Em Análise";
    $anexo = $_FILES['anexo'];
    $anexo_nome = $anexo['name'][0];

    $atualiza = $db->prepare("UPDATE lancamento SET setor_idsetor = :setor, peca_servico_idpeca_servico = :produto, fornecedor_idfornecedor = :fornecedor, valor_und = :valorUn, qtd = :qtd, valor_total = :valorTotal, cod_fabrica = :codFabrica, status_atual = :situacao, obs_orcamento = :obsOrcamento, obs_analise = :obsAnalise, anexo = :anexo WHERE idlancamento = :idLancamento ");
    $atualiza->bindValue(':setor', $setor);
    $atualiza->bindValue(':produto', $produto);
    $atualiza->bindValue(':fornecedor', $fornecedor);
    $atualiza->bindValue(':valorUn', $valorUnit);
    $atualiza->bindValue(':qtd', $qtd);
    $atualiza->bindValue(':valorTotal', $valorTotal);
    $atualiza->bindValue(':codFabrica', $codFabrica);
    $atualiza->bindValue(':situacao', $situacao);
    $atualiza->bindValue(':obsOrcamento', $obsOrcamento);
    $atualiza->bindValue(':obsAnalise', $obsAnalise);
    $atualiza->bindValue(':anexo', $anexo_nome);
    $atualiza->bindValue(':idLancamento', $idlancamento);
    

    //print_r($atualiza->errorInfo());

    //echo "$idProduto <br>$nomeProduto<br>$codBarra<br>$categoria";

    if($atualiza->execute()){
        for($i=0;$i<count($anexo['name']);$i++){

            $destino = "uploads/".$idlancamento."/".$anexo['name'] [$i];
            move_uploaded_file($anexo['tmp_name'][$i], $destino);

        }
        echo "<script> alert('Atualizado com Sucesso!')</script>";
        echo "<script> window.location.href='despesas.php' </script>";
    }else{
        print_r($db->errorInfo());
    }

}else{
    header("Location:despesas.php");
}

?>