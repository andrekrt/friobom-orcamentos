<?php 

session_start();
require("../conexao.php");

if(isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario'])==false){

    $idUsuario = $_SESSION['id_usuario'];  
    $tipoUsuario = $_SESSION['tipo_usuario']; 
    $nomeUsuario = $_SESSION['nome_usuario'];
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
    $selecionar = $db->query("SELECT * FROM patrimonio");

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
        <title>PATRIMÔNIO</title>
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
                                <li class="nav-item"> <a href="../despesas/gerar-planilha.php" class="nav-link"> Gerar Relatório </a> </li>
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
                        <h2>Patrimônio</h2>
                   </div>
                </div>
                <!-- dados exclusivo da página-->
                <div class="menu-principal">
                    <div class="table-responsive">
                        <table class="table table-striped table-dark table-bordered"> 
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center text-nowrap"> Setor </th>
                                    <th scope="col" class="text-center text-nowrap"> Produto</th>
                                    <th scope="col" class="text-center text-nowrap"> Qtd</th>                                    
                                    <th scope="col" class="text-center text-nowrap"> Ações </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $totalPatrimonio = $selecionar->rowCount();
                                $qtdPorPagina = 10;
                                $numPaginas = ceil($totalPatrimonio/$qtdPorPagina);
                                $paginaInicial = ($qtdPorPagina*$pagina)-$qtdPorPagina;
                                $limitado = $db->query("SELECT * FROM patrimonio LEFT JOIN setor ON patrimonio.setor_idsetor = setor.idsetor LEFT JOIN produto_servico ON patrimonio.produto_idproduto = produto_servico.idpeca_servico LIMIT $paginaInicial,$qtdPorPagina");
                                
                                if($limitado->rowCount()>0){
                                    $dados = $limitado->fetchAll();
                                    foreach($dados as $dado){
                                ?>
                                <tr id="<?php echo $dado['idpatrimonio'] ?>">
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['nome_setor']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['nome_peca_servico']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['qtd_patrimonio']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap">
                                        <?php

                                            if($dado['usuarios_idusuarios'] == $idUsuario || $tipoUsuario==1 || $tipoUsuario == 99){
                                        ?>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal<?php echo $dado['idpatrimonio']; ?>" data-whatever="@mdo" value="<?php echo $dado['idpatrimonio']; ?>" name="idpatrimonio" >Visualisar</button>
                                        <?php
                                            }

                                        ?>
                                        
                                    </td>
                                </tr>
                                <!-- INICIO MODAL visualisar patrimonio-->
                                <div class="modal fade" id="modal<?php echo $dado['idpatrimonio']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Patrimônio</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="atualiza.php" enctype="multipart/form-data" method="post">
                                                    <div class="form-row">
                                                        <input type="text" class="form-control" name="idPatrimonio" value="<?php echo $dado['idpatrimonio'];  ?>">
                                                        <div class="form-group col-md-4">
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
                                                        <div class="form-group col-md-4">
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
                                                        <div class="form-group col-md-4">
                                                            <label for="qtdPatrimonio" class="col-form-label"> Qtd.  </label>
                                                            <input type="text" name="qtdPatrimonio" class="form-control"  id="qtdPatrimonio" value="<?php echo $dado['qtd_patrimonio'];  ?>">
                                                        </div>
                                                    </div>          
                                            </div>
                                            <div class="modal-footer">
                                                    <a href="excluir.php?idPatrimonio=<?php echo $dado['idpatrimonio']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')" > Excluir </a>
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