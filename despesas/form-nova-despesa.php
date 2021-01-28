<?php 

session_start();
require("../conexao.php");

if(isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario'])==false){

    $idUsuario = $_SESSION['id_usuario'];
    $nomeUsuario = $_SESSION['nome_usuario'];
    
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
        <title>Lançar Despesa</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
            <!-- finalizando menu lateral -->
            <!-- Tela com os dados -->
            <div class="tela-principal">
                <div class="menu-superior">
                   <div class="icone-menu-superior">
                        <img src="../assets/images/icones/despesa.png" alt="">
                   </div>
                   <div class="title">
                        <h2>Lançar Despesas</h2>
                   </div>
                </div>
                <!-- dados exclusivo da página-->
                <div class="menu-principal">
                    <form action="add-despesa.php" id="despesa" method="post" enctype="multipart/form-data">
                        <div id="formulario">
                            <button type="button" class="btn btn-danger" id="add-item">Adicionar itens</button>
                            <div class="form-row">
                                <div class="form-group col-md-12 espaco">
                                    <label for="fornecedor">Fornecedor</label>
                                    <select required name="fornecedor" id="fornecedor" class="form-control">
                                        <option value=""></option>
                                    <?php 

                                        $sql = $db->query("SELECT * FROM fornecedor");
                                        $fornecedores = $sql->fetchAll();

                                        foreach($fornecedores as $fornecedor){
                                    ?>
                                        <option value="<?php echo $fornecedor['idfornecedor'] ?>"> <?php echo $fornecedor['nome_fornecedor'] ?> </option>
                                    <?php        
                                        }

                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2 espaco">
                                    <label for="setor"> Setor </label>
                                    <select name="setor[]" required id="setor" class="form-control">
                                        <option value=""></option>
                                    <?php
                                    
                                        $setores = $db->query("SELECT * FROM setor");
                                        $setores=$setores->fetchAll();
                                        foreach($setores as $setor){
                                    ?>
                                        <option value="<?php echo $setor['idsetor']; ?>"><?php echo $setor['nome_setor'] ?></option>
                                    <?php        
                                        }

                                    ?>
                                    </select>
                                </div>
                                <!--
                                <div class="icone-plus">
                                    <img src="../assets/images/icones/plus.png" data-toggle="modal" data-target="#modalCategoria" data-whatever="@mdo" value="" name="modalCategoria"> 
                                </div>
                                -->
                                <!--
                                <div class="icone-plus">
                                    <img src="../assets/images/icones/plus.png" data-toggle="modal" data-target="#modalCategoria" data-whatever="@mdo" value="" name="modalCategoria"> 
                                </div>
                                -->
                                <!--
                                <div class="icone-plus">
                                    <img src="../assets/images/icones/plus.png" data-toggle="modal" data-target="#modalCategoria" data-whatever="@mdo" value="" name="modalCategoria"> 
                                </div>
                                -->
                                
                                <div class="form-group col-md-3 espaco">
                                    <label for="produto">Produto</label>
                                    <select required name="produto[]" id="produto" class="form-control">
                                        <option value=""></option>
                                        <?php 

                                            $sql = $db->query("SELECT * FROM produto_servico");
                                            $prdoutos = $sql->fetchAll();

                                            foreach($prdoutos as $produto){
                                        ?>
                                        <option value="<?php echo $produto['idpeca_servico'] ?>"> <?php echo $produto['nome_peca_servico'] ?> </option>
                                        <?php        
                                            }

                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 espaco">
                                    <label for="codFabrica">Código de Fábrica</label>
                                    <input type="text" class="form-control" name="codFabrica[]" id="codFabrica">
                                </div>
                                <div class="form-group col-md-2 espaco">
                                    <label for="vlUn">Valor Unitário</label>
                                    <input type="text" required class="form-control" name="vlUn[]" id="vlUn">
                                </div>
                                <div class="form-group col-md-2 espaco">
                                    <label for="qtd">Quantidade</label>
                                    <input type="text" required class="form-control" name="qtd[]" id="qtd">
                                </div>
                                <!--
                                <div class="icone-plus">
                                    <img src="../assets/images/icones/plus.png" data-toggle="modal" data-target="#modalCategoria" data-whatever="@mdo" value="" name="modalCategoria"> 
                                </div>
                                -->
                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-5 espaco">
                                    <label for="anexo">Inserir Anexos</label>
                                    <input type="file" class="form-control-file" multiple="multiple" name="anexo[]" id="anexo">
                                </div>
                                <div class="form-group col-md-7 espaco">
                                    <label for="obsOrcamento">Observações</label>
                                    <textarea class="form-control" name="obsOrcamento" id="obsOrcamento" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="solicitar" id="solicitar" class="btn btn-primary">Solicitar</button>
                        </div>
                       
                    </form>
                    <!-- INICIO MODAL add categoria-->
                    <div class="modal fade" id="modalCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Nova Categoria</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="add-categoria.php" method="post">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="categoria" class="col-form-label">Categoria</label>
                                                <input type="text" name="categoria" class="form-control"  id="categoria">
                                            </div>
                                        </div>    
                                </div>
                                <div class="modal-footer">
                                        <button type="submit" name="analisar" class="btn btn-primary">Cadastrar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIM MODAL -->
                </div>
            </div>
        </div>

        <script src="../assets/js/jquery.js"></script>
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/menu.js"></script>

        <script>
            $(document).ready(function(){

                var cont = 1;
                $('#add-item').click(function(){
                    cont++;

                    $('#formulario').append('<div class="form-row"> <div class="form-group col-md-2 espaco"> <label for="setor"> Setor </label> <select name="setor[]" required id="setor" class="form-control"> <option value=""></option> <?php
                                    
                                        $setores = $db->query("SELECT * FROM setor");
                                        $setores=$setores->fetchAll();
                                        foreach($setores as $setor){
                                    ?>
                                        <option value="<?php echo $setor['idsetor']; ?>"><?php echo $setor['nome_setor'] ?></option> <?php        
                                        }

                                    ?> </select> </div> <div class="form-group col-md-3 espaco"> <label for="produto">Produto</label> <select required name="produto[]" id="produto" class="form-control"> <option value=""></option> <?php 

                                    $sql = $db->query("SELECT * FROM produto_servico");
                                    $prdoutos = $sql->fetchAll();

                                    foreach($prdoutos as $produto){
                                ?>
                                <option value="<?php echo $produto['idpeca_servico'] ?>"> <?php echo $produto['nome_peca_servico'] ?> </option> <?php        
                                    }

                                ?>
                            </select> </div> <div class="form-group col-md-3 espaco"> <label for="codFabrica">Código de Fábrica</label> <input type="text" class="form-control" name="codFabrica[]" id="codFabrica"> </div> <div class="form-group col-md-2 espaco"> <label for="vlUn">Valor Unitário</label> <input type="text" required class="form-control" name="vlUn[]" id="vlUn"> </div>  <div class="form-group col-md-2 espaco"> <label for="qtd">Quantidade</label> <input type="text" required class="form-control" name="qtd[]" id="qtd"> </div>  </div');
                });

                /*$("#solicitar").click(function () {
                    //Receber os dados do formulário
                    var dados = $("#despesa").serialize();
                    $.post("add-despesa.php", dados);
                });*/

            });
        </script>
    </body>
</html>