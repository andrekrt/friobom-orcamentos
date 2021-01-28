<?php 

session_start();
require("../conexao.php");

if(isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario'])==false){
    
    $nomeUsuario = $_SESSION['nome_usuario'];
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
    $selecionar = $db->query("SELECT * FROM produto_servico");

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
        <title>PRODUTOS / SERVIÇOS</title>
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
                        <img src="../assets/images/icones/produtos.png" alt="">
                   </div>
                   <div class="title">
                        <h2>Produtos e Serviços</h2>
                   </div>
                </div>
                <!-- dados exclusivo da página-->
                <div class="menu-principal">
                    <div class="table-responsive">
                        <table class="table table-striped table-dark table-bordered"> 
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center text-nowrap">ID Produto</th>
                                    <th scope="col" class="text-center text-nowrap">Produto/Serviço</th>
                                    <th scope="col" class="text-center text-nowrap"> Código de Barras</th>
                                    <th scope="col" class="text-center text-nowrap">Categoria</th>
                                    <th scope="col" class="text-center text-nowrap">Tipo</th>
                                    <th scope="col" class="text-center text-nowrap"> Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $totalProduto = $selecionar->rowCount();
                                $qtdPorPagina = 10;
                                $numPaginas = ceil($totalProduto/$qtdPorPagina);
                                $paginaInicial = ($qtdPorPagina*$pagina)-$qtdPorPagina;
                                $limitado = $db->query("SELECT * FROM produto_servico LEFT JOIN categoria ON produto_servico.categoria_idcategoria = categoria.idcategoria LIMIT $paginaInicial,$qtdPorPagina ");
                                
                                if($limitado->rowCount()>0){
                                    $dados = $limitado->fetchAll();
                                    foreach($dados as $dado){
                                ?>
                                <tr id="<?php echo $dado['idpeca_servico'] ?>">
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['idpeca_servico']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['nome_peca_servico']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['cod_barra']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['nome_categoria']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['tipo_produto']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal<?php echo $dado['idpeca_servico']; ?>" data-whatever="@mdo" value="<?php echo $dado['idpeca_servico']; ?>" name="idpeca_servico" >Visualisar</button>
                                    </td>
                                </tr>
                                <!-- INICIO MODAL visualisar produto-->
                                <div class="modal fade" id="modal<?php echo $dado['idpeca_servico']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Produto/Serviço</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="atualiza.php" method="post">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label for="idProduto" class="col-form-label">ID</label>
                                                            <input type="text" name="idProduto" class="form-control" readonly id="idProduto" value="<?php echo $dado['idpeca_servico'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label for="nomeProduto" class="col-form-label">Nome Produto/Serviço</label>
                                                            <input type="text" name="nomeProduto" class="form-control"  id="nomeProduto" value="<?php echo $dado['nome_peca_servico'];  ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label for="codBarras" class="col-form-label">Código de Barras</label>
                                                            <input type="text" name="codBarras" class="form-control"  id="codBarras" value="<?php echo $dado['cod_barra'];  ?>">
                                                        </div>
                                                    </div>   
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="categoria" class="col-form-label">Categoria</label>
                                                            <select name="categoria" class="form-control" id="categoria">
                                                                <option value="<?php echo $dado['idcategoria']; ?>"> <?php echo $dado['nome_categoria']; ?> </option>
                                                                <?php 
                                                                
                                                                    $consulta = $db->query("SELECT * FROM categoria");
                                                                    $categorias = $consulta->fetchAll();

                                                                    foreach($categorias as $categoria){
                                                                ?>
                                                                <option value="<?php echo $categoria['idcategoria']; ?>"><?php echo $categoria['nome_categoria']; ?></option>
                                                                <?php        

                                                                    }

                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="tipoProduto" class="col-form-label">Tipo Produto</label>
                                                            <select name="tipoProduto" class="form-control" id="tipoProduto">
                                                                <option value="<?php echo $dado['tipo_produto'] ?>"> <?php echo $dado['tipo_produto'] ?> </option>
                                                                <option value="Patrimônio">Patrimônio</option>
                                                                <option value="Despesa">Despesa</option>
                                                            </select>
                                                        </div>
                                                    </div>       
                                            </div>
                                            <div class="modal-footer">
                                                    <a href="excluir.php?idProduto=<?php echo $dado['idpeca_servico']; ?>" class="btn btn-danger" > Excluir </a>
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
                                echo "<a class='page-link' href='produtos.php?pagina=$paginaAnterior' aria-label='Anterior'>
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
                                echo "<li class='page-item'><a class='page-link' href='produtos.php?pagina=$i'>$i</a></li>";
                            }
                        ?>
                        <li class="page-item">
                        <?php
                            if($paginaPosterior <= $numPaginas){
                                echo " <a class='page-link' href='produtos.php?pagina=$paginaPosterior' aria-label='Próximo'>
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