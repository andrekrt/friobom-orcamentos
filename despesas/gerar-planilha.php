<?php

session_start();
require("../conexao.php");

$tipoUsuario = $_SESSION['tipo_usuario'];

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Planilha</title>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
        <link rel="manifest" href="../assets/favicon/site.webmanifest">
        <link rel="mask-icon" href="../assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body>
        <?php
        
            if($tipoUsuario == 1 || $tipoUsuario == 99){

                $arquivo = 'orcamento.xls';

                $html = '';
                $html .= '<table border="1">';
                $html .= '<tr>';
                $html .= '<td class="text-center font-weight-bold"> ID </td>';
                $html .= '<td class="text-center font-weight-bold"> Data Lançamento </td>';
                $html .= '<td class="text-center font-weight-bold"> Setor </td>';
                $html .= '<td class="text-center font-weight-bold"> Categoria </td>';
                $html .= '<td class="text-center font-weight-bold"> Produto </td>';
                $html .= '<td class="text-center font-weight-bold"> Fornecedor </td>';
                $html .= '<td class="text-center font-weight-bold"> Cód. Fábrica </td>';
                $html .= '<td class="text-center font-weight-bold"> Cód. Barra </td>';
                $html .= '<td class="text-center font-weight-bold"> Valor Und. </td>';
                $html .= '<td class="text-center font-weight-bold"> Quant. </td>';
                $html .= '<td class="text-center font-weight-bold"> Valor Total </td>';
                $html .= '<td class="text-center font-weight-bold"> Solicitante </td>';
                $html .= '<td class="text-center font-weight-bold"> Situação </td>';
                $html .= '</tr>';

                $sql = $db->query("SELECT * FROM lancamento LEFT JOIN setor ON lancamento.setor_idsetor = setor.idsetor LEFT JOIN produto_servico ON lancamento.peca_servico_idpeca_servico = produto_servico.idpeca_servico LEFT JOIN categoria ON produto_servico.categoria_idcategoria = categoria.idcategoria LEFT JOIN fornecedor ON lancamento.fornecedor_idfornecedor = fornecedor.idfornecedor LEFT JOIN usuarios ON lancamento.usuarios_idusuarios = usuarios.idusuarios");
                $dados = $sql->fetchAll();
                foreach($dados as $dado){
                    $html .= '<tr>';
                    $html .= '<td>' .$dado['idlancamento'].  '</td>';
                    $html .= '<td>' .$dado['data_lancamento'].  '</td>';
                    $html .= '<td>' .$dado['nome_setor'].  '</td>';
                    $html .= '<td>' .$dado['nome_categoria'].  '</td>';
                    $html .= '<td>' .$dado['nome_peca_servico'].  '</td>';
                    $html .= '<td>' .$dado['nome_fornecedor'].  '</td>';
                    $html .= '<td>' .$dado['cod_fabrica'].  '</td>';
                    $html .= '<td>' .$dado['cod_barra'].  '</td>';
                    $html .= '<td>' .$dado['valor_und'].  '</td>';
                    $html .= '<td>' .$dado['qtd'].  '</td>';
                    $html .= '<td>' .$dado['valor_total'].  '</td>';
                    $html .= '<td>' .$dado['nome'].  '</td>';
                    $html .= '<td>' .$dado['status_atual'].  '</td>';
                    $html .= '</tr>';
                }

                $html .= '</table>';

                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$arquivo.'"');
                header('Cache-Control: max-age=0');
                header('Cache-Control: max-age=1');

                echo $html;
                exit;

            }
        
        ?>
    </body>
</html>