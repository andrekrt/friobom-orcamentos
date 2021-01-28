<?php

session_start();
require("../conexao.php");

if( isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario'])==false){

    $idUsuario = $_SESSION['id_usuario'];
    $dataSolicitacao = date("Y/m/d");
    $setor = $_POST['setor'];
    $produtos = $_POST['produto'];
    $fornecedor = $_POST['fornecedor'];
    $codFabricas = $_POST['codFabrica'];
    $valorUn = str_replace(",", ".", $_POST['vlUn']) ;
    $qtd = str_replace(",", ".", $_POST['qtd']) ;
    $statusAtual = "Em Análise";
    $anexo = $_FILES['anexo'];
    $anexo_nome = $anexo['name'][0];
    $obsOrcamento = $_POST['obsOrcamento'];

    $qtdProdutos = count($produtos);

    /*echo "Qtd de Produtos: $qtdProdutos <br>";

    print_r($produtos)."<br>";
    print_r($codFabricas)."<br>";
    print_r($valorUn)."<br>";
    print_r($qtd)."<br>";*/

    for($cont=0; $cont<count($produtos); $cont++){
        $valorTotal = $valorUn[$cont]*$qtd[$cont];

       $sql= $db->prepare("INSERT INTO lancamento (data_lancamento, setor_idsetor, peca_servico_idpeca_servico, fornecedor_idfornecedor, cod_fabrica, valor_und, qtd, valor_total, anexo, obs_orcamento, status_atual, usuarios_idusuarios) VALUES (:dataSolicitacao, :setor, :produto, :fornecedor, :codFabrica, :valorUn, :qtd, :valorTotal, :anexos, :obsOrcamento, :statusAtual, :usuario)");

        $sql->bindValue(':dataSolicitacao', $dataSolicitacao);
        $sql->bindValue(':setor', $setor[$cont]);
        $sql->bindValue(':produto', $produtos[$cont]);
        $sql->bindValue(':fornecedor', $fornecedor);
        $sql->bindValue(':codFabrica', $codFabricas[$cont]);
        $sql->bindValue(':valorUn', $valorUn[$cont]);
        $sql->bindValue(':qtd', $qtd[$cont]);
        $sql->bindValue(':valorTotal', $valorTotal);
        $sql->bindValue(':anexos', $anexo_nome);
        $sql->bindValue(':obsOrcamento', $obsOrcamento);
        $sql->bindValue(':statusAtual', $statusAtual);
        $sql->bindValue(':usuario', $idUsuario);
        

        if($sql->execute()){
            $ultimoId = $db->lastInsertId();
            $diretorio = "uploads/". $ultimoId;
            mkdir($diretorio, 0755);
            for($i=0;$i<count($anexo['name']);$i++){

                $destino = "uploads/".$ultimoId."/".$anexo['name'] [$i];
                move_uploaded_file($anexo['tmp_name'][$i], $destino);
                

            }
            echo "<script>alert('Despesa Solicitada!');</script>";
            echo "<script>window.location.href='despesas.php'</script>";
        }else{
            print_r($db->errorInfo());
            
        }
        
    }

}

?>