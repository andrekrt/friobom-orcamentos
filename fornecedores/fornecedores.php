<?php 

session_start();
require("../conexao.php");

if(isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario'])==false){
    
    $nomeUsuario = $_SESSION['nome_usuario'];
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
    $selecionar = $db->query("SELECT * FROM fornecedor");

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
        <title>FORNECEDORES</title>
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
                        <img src="../assets/images/icones/fornecedor.png" alt="">
                   </div>
                   <div class="title">
                        <h2>Fornecedores</h2>
                   </div>
                </div>
                <!-- dados exclusivo da página-->
                <div class="menu-principal">
                    <div class="table-responsive">
                        <table class="table table-striped table-dark table-bordered"> 
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center text-nowrap">ID Fornecedor</th>
                                    <th scope="col" class="text-center text-nowrap">Fornecedor</th>
                                    <th scope="col" class="text-center text-nowrap"> CNPJ</th>
                                    <th scope="col" class="text-center text-nowrap">Endereço</th>
                                    <th scope="col" class="text-center text-nowrap"> N°</th>
                                    <th scope="col" class="text-center text-nowrap"> Bairro</th>
                                    <th scope="col" class="text-center text-nowrap"> Cidade</th>
                                    <th scope="col" class="text-center text-nowrap"> Estado</th>
                                    <th scope="col" class="text-center text-nowrap"> Telefone</th>
                                    <th scope="col" class="text-center text-nowrap"> Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $totalFornecedor = $selecionar->rowCount();
                                $qtdPorPagina = 10;
                                $numPaginas = ceil($totalFornecedor/$qtdPorPagina);
                                $paginaInicial = ($qtdPorPagina*$pagina)-$qtdPorPagina;
                                $limitado = $db->query("SELECT * FROM fornecedor LIMIT $paginaInicial,$qtdPorPagina ");
                                
                                if($limitado->rowCount()>0){
                                    $dados = $limitado->fetchAll();
                                    foreach($dados as $dado){
                                ?>
                                <tr id="<?php echo $dado['idfornecedor'] ?>">
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['idfornecedor']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['nome_fornecedor']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['cnpj']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['endereco']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['num_estab']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['bairro']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['cidade']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['estado']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap"> <?php echo $dado['telefone']; ?> </td>
                                    <td scope="col" class="text-center text-nowrap">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal<?php echo $dado['idfornecedor']; ?>" data-whatever="@mdo" value="<?php echo $dado['idfornecedor']; ?>" name="idfornecedor" >Visualisar</button>
                                    </td>
                                </tr>
                                <!-- INICIO MODAL visualisar produto-->
                                <div class="modal fade" id="modal<?php echo $dado['idfornecedor']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                            <label for="idFornecedor" class="col-form-label">ID</label>
                                                            <input type="text" name="idFornecedor" class="form-control" readonly id="idFornecedor" value="<?php echo $dado['idfornecedor'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="fornecedor" class="col-form-label">Fornecedor</label>
                                                            <input type="text" name="fornecedor" class="form-control"  id="fornecedor" value="<?php echo $dado['nome_fornecedor'];  ?>">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="cnpj" class="col-form-label">CNPJ</label>
                                                            <input type="text" name="cnpj" class="form-control"  id="cnpj" value="<?php echo $dado['cnpj'];  ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-5">
                                                            <label for="endereco" class="col-form-label"> Endereço </label>
                                                            <input type="text" name="endereco" class="form-control"  id="endereco" value="<?php echo $dado['endereco'];  ?>">
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="numEstab" class="col-form-label"> N° </label>
                                                            <input type="text" name="numEstab" class="form-control"  id="numEstab" value="<?php echo $dado['num_estab'];  ?>">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="bairro" class="col-form-label"> Bairro </label>
                                                            <input type="text" name="bairro" class="form-control"  id="bairro" value="<?php echo $dado['bairro'];  ?>">
                                                        </div>
                                                    </div>   
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="cidade" class="col-form-label">Cidade</label>
                                                            <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $dado['cidade'] ?>">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="estado" class="col-form-label">Estado</label>
                                                            <select class="form-control" id="estado" name="estado">
                                                                <option value="<?php echo $dado['estado'] ?>"> <?php echo $dado['estado'] ?> </option>
                                                                <option value="AC">Acre</option>
                                                                <option value="AL">Alagoas</option>
                                                                <option value="AP">Amapá</option>
                                                                <option value="AM">Amazonas</option>
                                                                <option value="BA">Bahia</option>
                                                                <option value="CE">Ceará</option>
                                                                <option value="DF">Distrito Federal</option>
                                                                <option value="ES">Espirito Santo</option>
                                                                <option value="GO">Goiás</option>
                                                                <option value="MA">Maranhão</option>
                                                                <option value="MS">Mato Grosso do Sul</option>
                                                                <option value="MT">Mato Grosso</option>
                                                                <option value="MG">Minas Gerais</option>
                                                                <option value="PA">Pará</option>
                                                                <option value="PB">Paraíba</option>
                                                                <option value="PR">Paraná</option>
                                                                <option value="PE">Pernambuco</option>
                                                                <option value="PI">Piauí</option>
                                                                <option value="RJ">Rio de Janeiro</option>
                                                                <option value="RN">Rio Grande do Norte</option>
                                                                <option value="RS">Rio Grande do Sul</option>
                                                                <option value="RO">Rondônia</option>
                                                                <option value="RR">Roraima</option>
                                                                <option value="SC">Santa Catarina</option>
                                                                <option value="SP">São Paulo</option>
                                                                <option value="SE">Sergipe</option>
                                                                <option value="TO">Tocantins</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="telefone" class="col-form-label">Telefone</label>
                                                            <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $dado['telefone'] ?>">
                                                        </div>
                                                    </div>       
                                            </div>
                                            <div class="modal-footer">
                                                    <a href="excluir.php?idFornecedor=<?php echo $dado['idfornecedor']; ?>" class="btn btn-danger" > Excluir </a>
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
                                echo "<a class='page-link' href='fornecedores.php?pagina=$paginaAnterior' aria-label='Anterior'>
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
                                echo "<li class='page-item'><a class='page-link' href='fornecedores.php?pagina=$i'>$i</a></li>";
                            }
                        ?>
                        <li class="page-item">
                        <?php
                            if($paginaPosterior <= $numPaginas){
                                echo " <a class='page-link' href='fornecedores.php?pagina=$paginaPosterior' aria-label='Próximo'>
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
        <script src="../assets/js/jquery.mask.js"></script>
        <script>
            $(document).ready(function(){
                $('#telefone').mask('(99)99999-9999');
            });
        </script>
        <script>
            $(document).ready(function(){
                $('#cnpj').mask('99.999.999/9999-99');
            });
        </script>
    </body>
</html>