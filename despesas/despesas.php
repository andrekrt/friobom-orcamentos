<?php 

session_start();
require("../conexao.php");

if(isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario'])==false){

    $idUsuario = $_SESSION['id_usuario'];  
    $tipoUsuario = $_SESSION['tipo_usuario']; 
    $nomeUsuario = $_SESSION['nome_usuario'];
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
    $selecionar = $db->query("SELECT * FROM lancamento");

}else{
    echo "<script>alert('Acesso não permitido');</script>";
    echo "<script>window.location.href='../index.php'</script>";
}

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DESPESAS</title>
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
        <div class="container-fluid corpo">
            <div class="menu-lateral">
                <div class="logo">  
                    <img src="../assets/images/logo.png" alt="">
                </div>
                <div class="opcoes">
                    <div class="item">
                        <a href="../index.php">
                            <img src="../assets/images/menu/inicio.png" alt="">
                        </a>
                    </div>
                    <div class="item"> 
                        <a onclick="menuSetores()">
                            <img src="../assets/images/menu/setor.png" alt="">
                        </a>
                        <nav id="submenuSetor">
                            <ul class="nav flex-column">
                                <li class="nav-item"> <a href="../setores/setores.php" class="nav-link"> Listar Setores </a> </li>
                                <li class="nav-item"> <a href="../setores/form-novo-setor.php" class="nav-link"> Novo Setor </a> </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="item"> 
                        <a onclick="menuCategoria()">
                            <img src="../assets/images/menu/categoria.png" alt="">
                        </a>
                        <nav id="submenuCategoria">
                            <ul class="nav flex-column">
                                <li class="nav-item"> <a href="../categorias/categorias.php" class="nav-link"> Listar Categorias </a> </li>
                                <li class="nav-item"> <a href="../categorias/form-nova-categoria.php" class="nav-link"> Nova Categoria </a> </li>
                            </ul>
                        </nav>
                    </div> 
                    <div class="item"> 
                        <a onclick="menuPeca()">
                            <img src="../assets/images/menu/produto.png" alt="">
                        </a>
                        <nav id="submenuPeca">
                            <ul class="nav flex-column">
                                <li class="nav-item"> <a href="../produtos/produtos.php" class="nav-link"> Listar Produtos </a> </li>
                                <li class="nav-item"> <a href="../produtos/form-novo-produto.php" class="nav-link"> Novo Produto </a> </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="item"> 
                        <a onclick="menuFornecedor()">
                            <img src="../assets/images/menu/fornecedor.png" alt="">
                        </a>
                        <nav id="submenuFornecedor">
                            <ul class="nav flex-column">
                                <li class="nav-item"> <a href="../fornecedores/fornecedores.php" class="nav-link"> Listar Fornecedores </a> </li>
                                <li class="nav-item"> <a href="../fornecedores/form-novo-fornecedor.php" class="nav-link"> Novo Fornecedor </a> </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="item"> 
                        <a onclick="menuDespesa()">
                            <img src="../assets/images/menu/despesa.png" alt="">
                        </a>
                        <nav id="submenuDespesa">
                            <ul class="nav flex-column">
                                <li class="nav-item"> <a href="../despesas/despesas.php" class="nav-link"> Listar Lançamentos </a> </li>
                                <li class="nav-item"> <a href="../despesas/form-nova-despesa.php" class="nav-link"> Nova Despesa(Custo) </a> </li>
                            </ul>
                        </nav>
                    </div>  
                    <div class="item">
                        <a onclick="menuPatrimonio()">
                            <img src="../assets/images/menu/patrimonio.png" alt="">
                        </a>
                        <nav id="submenuPatrimonio">
                            <ul class="nav flex-column">
                                <li class="nav-item"> <a class="nav-link" href="../patrimonio/patrimonio.php">Patrimônio</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="../patrimonio/form-novo-patrimonio.php">Novo Patrimônio</a> </li>
                            </ul>
                        </nav>
                    </div>      
                    <div class="item">
                        <a href="../sair.php">
                            <img src="../assets/images/menu/sair.png" alt="">
                        </a>
                    </div>
                </div>                
            </div>
            <!-- Tela com os dados -->
            <div class="tela-principal">
                <div class="menu-superior">
                   <div class="icone-menu-superior">
                        <img src="../assets/images/icones/despesa.png" alt="">
                   </div>
                   <div class="title">
                        <h2>Despesas Lançadas</h2>
                   </div>
                </div>
                <!-- dados exclusivo da página-->
                <div class="menu-principal">
                    <div class="table-responsive">
                        <table class="table table-striped table-dark table-bordered"> 
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center text-nowrap">ID</th>
                                    <th scope="col" class="text-center text-nowrap">Data Lançamento</th>
                                    <th scope="col" class="text-center text-nowrap"> Setor </th>
                                    <th scope="col" class="text-center text-nowrap">Categoria</th>
                                    <th scope="col" class="text-center text-nowrap"> Produto</th>
                                    <th scope="col" class="text-center text-nowrap"> Fornecedor</th>
                                    <th scope="col" class="text-center text-nowrap"> Cód. Fábrica </th>
                                    <th scope="col" class="text-center text-nowrap"> Valor Unit.</th>
                                    <th scope="col" class="text-center text-nowrap"> Qtd</th>
                                    <th scope="col" class="text-center text-nowrap"> 
                                    Valor Total</th>
                                    <th scope="col" class="text-center text-nowrap">Anexos</th>
                                    <th scope="col" class="text-center text-nowrap"> Solicitante </th>
                                    <th scope="col" class="text-center text-nowrap"> Situação </th>
                                    <th scope="col" class="text-center text-nowrap"> Ações </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $totalProduto = $selecionar->rowCount();
                                $qtdPorPagina = 10;
                                $numPaginas = ceil($totalProduto/$qtdPorPagina);
                                $paginaInicial = ($qtdPorPagina*$pagina)-$qtdPorPagina;
                                $limitado = $db->query("SELECT * FROM lancamento LEFT JOIN setor ON lancamento.setor_idsetor = setor.idsetor LEFT JOIN produto_servico ON lancamento.peca_servico_idpeca_servico = produto_servico.idpeca_servico LEFT JOIN categoria ON produto_servico.categoria_idcategoria = categoria.idcategoria LEFT JOIN fornecedor ON lancamento.fornecedor_idfornecedor = fornecedor.idfornecedor LEFT JOIN usuarios ON lancamento.usuarios_idusuarios = usuarios.idusuarios ORDER BY idlancamento DESC LIMIT $paginaInicial,$qtdPorPagina ");
                                
                                if($limitado->rowCount()>0){
                                    $dados = $limitado->fetchAll();
                                    foreach($dados as $dado){
                                ?>
                                <tr id="<?php echo $dado['idlancamento'] ?>">
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['idlancamento']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo date("d/m/Y", strtotime($dado['data_lancamento'])); ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['nome_setor']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['nome_categoria']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['nome_peca_servico']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['nome_fornecedor']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['cod_fabrica']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['valor_und']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['qtd']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['valor_total']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> 
                                        <a target="_blank" href="uploads/<?php echo $dado['idlancamento'] ?>"> Anexos</a>
                                    </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['nome']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['status_atual']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap">
                                        <?php

                                            if($dado['usuarios_idusuarios'] == $idUsuario || $tipoUsuario==1 || $tipoUsuario == 99){
                                        ?>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal<?php echo $dado['idlancamento']; ?>" data-whatever="@mdo" value="<?php echo $dado['idlancamento']; ?>" name="idlancamento" >Visualisar</button>
                                        <?php
                                            }

                                        ?>
                                        
                                    </td>
                                </tr>
                                <!-- INICIO MODAL visualisar DESPESAS-->
                                <div class="modal fade" id="modal<?php echo $dado['idlancamento']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Despesas</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="atualiza.php" enctype="multipart/form-data" method="post">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-2">
                                                            <label for="idLancamento" class="col-form-label">ID</label>
                                                            <input type="text" name="idLancamento" class="form-control" readonly id="idLancamento" value="<?php echo $dado['idlancamento'] ?>">
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="fornecedor" class="col-form-label">Fornecedor</label>
                                                            <select class="form-control" name="fornecedor" id="fornecedor" >
                                                                <option value="<?php echo $dado['idfornecedor']; ?>"><?php echo $dado['nome_fornecedor']; ?></option>
                                                            <?php 
                                                            
                                                                $setores = $db->query("SELECT * FROM fornecedor");
                                                                $setores =$setores->fetchAll();
                                                                foreach($setores as $setor){
                                                            ?>
                                                                <option value="<?php $setor['idfornecedor']; ?>"> <?php echo $setor['nome_fornecedor'] ?> </option>
                                                            <?php        

                                                                }
                                                            
                                                            ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="setor" class="col-form-label">Setor</label>
                                                            <select class="form-control" name="setor" id="setor" >
                                                                <option value="<?php echo $dado['idsetor']; ?>"><?php echo $dado['nome_setor']; ?></option>
                                                            <?php 
                                                            
                                                                $setores = $db->query("SELECT * FROM setor");
                                                                $setores =$setores->fetchAll();
                                                                foreach($setores as $setor){
                                                            ?>
                                                                <option value="<?php $setor['idsetor']; ?>"> <?php echo $setor['nome_setor'] ?> </option>
                                                            <?php        

                                                                }
                                                            
                                                            ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="produto" class="col-form-label">Produto / Serviço</label>
                                                            <select class="form-control" name="produto" id="produto" >
                                                                <option value="<?php echo $dado['idpeca_servico']; ?>"><?php echo $dado['nome_peca_servico']; ?></option>
                                                            <?php 
                                                            
                                                                $produtos = $db->query("SELECT * FROM produto_servico");
                                                                $produtos =$produtos->fetchAll();
                                                                foreach($produtos as $produto){
                                                            ?>
                                                                <option value="<?php $produto['idpeca_servico']; ?>"> <?php echo $produto['nome_peca_servico'] ?> </option>
                                                            <?php        

                                                                }
                                                            
                                                            ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="codFabrica" class="col-form-label"> Cód. Fábrica  </label>
                                                            <input type="text" name="codFabrica" class="form-control"  id="codFabrica" value="<?php echo $dado['cod_fabrica'];  ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-1">
                                                            <label for="vlUn" class="col-form-label"> Valor Unit.  </label>
                                                            <input type="text" name="vlUn" class="form-control"  id="vlUn" value="<?php echo $dado['valor_und'];  ?>">
                                                        </div>
                                                        <div class="form-group col-md-1">
                                                            <label for="qtd" class="col-form-label"> Qtd.  </label>
                                                            <input type="text" name="qtd" class="form-control"  id="qtd" value="<?php echo $dado['qtd'];  ?>">
                                                        </div>
                                                        <div class="form-group col-md-1">
                                                            <label for="vlTotal" class="col-form-label"> Valor Total  </label>
                                                            <input type="text" readonly name="vlTotal" class="form-control"  id="vlTotal" value="<?php echo $dado['valor_total'];  ?>">
                                                        </div>
                                                    </div>   
                                                    <div class="form-row">
                                                        <div class="form-group col-md-5">
                                                            <label for="obsOrcamento">Observações</label>
                                                            <textarea class="form-control" name="obsOrcamento" id="obsOrcamento" > <?php echo $dado['obs_orcamento']; ?></textarea>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="anexo">Inserir Anexos</label>
                                                            <input type="file" class="form-control-file" multiple="multiple" value="<?php echo $dado['anexo'] ?>" name="anexo[]" id="anexo">
                                                        </div>
                                                        <?php
                                                            if($tipoUsuario==1 || $tipoUsuario == 99){
                                                        ?>
                                                            <div class="form-group col-md-6">
                                                                <label for="situacao" class="col-form-label">Situação</label>
                                                                <select name="situacao" class="form-control" id="situacao">
                                                                    <option value="<?php echo $dado['status_atual'] ?>"> <?php echo $dado['status_atual'] ?> </option>
                                                                    <option value="Aprovado">Aprovado</option>
                                                                    <option value="Reprovado">Reprovado</option>
                                                                    <option value="Em Análise"> Em Análise</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="obsAnalise" class="col-form-label">Observações de Análise</label>
                                                                <textarea class="form-control" name="obsAnalise" id="obsAnalise" > </textarea>
                                                            </div>
                                                        <?php        
                                                            }
                                                        ?>
                                                        
                                                    </div>       
                                            </div>
                                            <div class="modal-footer">
                                                    <a href="excluir.php?idLancamento=<?php echo $dado['idlancamento']; ?>" class="btn btn-danger" > Excluir </a>
                                                    <button type="submit" name="analisar" class="btn btn-primary">Atualizar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- FIM MODAL -->
                                <?php 
                                
                                    }
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- finalizando dados exclusivo da página -->
                <!-- Iniciando paginação -->
                <?php
            
                $paginaAnterior = $pagina-1;
                $paginaPosterior = $pagina+1;
                            
                ?>
                <nav aria-label="Navegação de página exemplo" class="paginacao">
                    <ul class="pagination">
                        <li class="page-item">
                        <?php
                            if($paginaAnterior!=0){
                                echo "<a class='page-link' href='despesas.php?pagina=$paginaAnterior' aria-label='Anterior'>
                                <span aria-hidden='true'>&laquo;</span>
                                <span class='sr-only'>Anterior</span>
                            </a>";
                            }else{
                                echo "<a class='page-link' aria-label='Anterior'> 
                                    <span aria-hidden='true'>&laquo;</span>
                                    <span class='sr-only'>Anterior</span>
                                </a>";
                            }
                        ?>
                        
                        </li>
                        <?php
                            for($i=1;$i < $numPaginas+1;$i++){
                                echo "<li class='page-item'><a class='page-link' href='despesas.php?pagina=$i'>$i</a></li>";
                            }
                        ?>
                        <li class="page-item">
                        <?php
                            if($paginaPosterior <= $numPaginas){
                                echo " <a class='page-link' href='despesas.php?pagina=$paginaPosterior' aria-label='Próximo'>
                                <span aria-hidden='true'>&raquo;</span>
                                <span class='sr-only'>Próximo</span>
                            </a>";
                            }else{
                                echo " <a class='page-link' aria-label='Próximo'>
                                        <span aria-hidden='true'>&raquo;</span>
                                        <span class='sr-only'>Próximo</span>
                                </a> ";
                            }
                        ?>
                    
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <script src="../assets/js/jquery.js"></script>
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/menu.js"></script>
    </body>
</html>