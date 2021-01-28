<?php 

session_start();
require("conexao.php");

if(isset($_SESSION['id_usuario']) && empty($_SESSION['id_usuario'])==false){

    $idUsuario = $_SESSION['id_usuario'];

    $sql = $db->prepare("SELECT * FROM usuarios WHERE idusuarios = :idUsuario");
    $sql->bindValue(':idUsuario', $idUsuario);
    $sql->execute();
    
    if($sql->rowCount()>0){
        $dado = $sql->fetch();

        $nomeUsuario = $dado['nome'];
        $tipoUsuario = $dado['tipo_usuario_idtipo_usuario'];

        $_SESSION['tipo_usuario'] = $tipoUsuario;
        $_SESSION['nome_usuario'] = $nomeUsuario;

        $qtdSetor = $db->query("SELECT * FROM setor")->rowCount();
        $qtdCategoria = $db->query("SELECT * FROM categoria")->rowCount();
        $qtdPecas = $db->query("SELECT * FROM produto_servico")->rowCount();
        $qtdLancamento = $db->query("SELECT * FROM lancamento")->rowCount();

    }else{
        header("Location:login.php");
    }
    
}else{
    header("Location:login.php");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FRIOBOM - DESPESAS GERAIS</title>
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
        <link rel="manifest" href="assets/favicon/site.webmanifest">
        <link rel="mask-icon" href="assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body>
        <div class="container-fluid corpo">
            <div class="menu-lateral">
                <div class="logo">  
                    <img src="assets/images/logo.png" alt="">
                </div>
                <div class="opcoes">
                    <div class="item">
                        <a href="index.php">
                            <img src="assets/images/menu/inicio.png" alt="">
                        </a>
                    </div>
                    <div class="item"> 
                        <a onclick="menuSetores()">
                            <img src="assets/images/menu/setor.png" alt="">
                        </a>
                        <nav id="submenuSetor">
                            <ul class="nav flex-column">
                                <li class="nav-item"> <a href="setores/setores.php" class="nav-link"> Listar Setores </a> </li>
                                <li class="nav-item"> <a href="setores/form-novo-setor.php" class="nav-link"> Novo Setor </a> </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="item"> 
                        <a onclick="menuCategoria()">
                            <img src="assets/images/menu/categoria.png" alt="">
                        </a>
                        <nav id="submenuCategoria">
                            <ul class="nav flex-column">
                                <li class="nav-item"> <a href="categorias/categorias.php" class="nav-link"> Listar Categorias </a> </li>
                                <li class="nav-item"> <a href="categorias/form-nova-categoria.php" class="nav-link"> Nova Categoria </a> </li>
                            </ul>
                        </nav>
                    </div> 
                    <div class="item"> 
                        <a onclick="menuPeca()">
                            <img src="assets/images/menu/produto.png" alt="">
                        </a>
                        <nav id="submenuPeca">
                            <ul class="nav flex-column">
                                <li class="nav-item"> <a href="produtos/produtos.php" class="nav-link"> Listar Produtos </a> </li>
                                <li class="nav-item"> <a href="produtos/form-novo-produto.php" class="nav-link"> Novo Produto </a> </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="item"> 
                        <a onclick="menuFornecedor()">
                            <img src="assets/images/menu/fornecedor.png" alt="">
                        </a>
                        <nav id="submenuFornecedor">
                            <ul class="nav flex-column">
                                <li class="nav-item"> <a href="fornecedores/fornecedores.php" class="nav-link"> Listar Fornecedores </a> </li>
                                <li class="nav-item"> <a href="fornecedores/form-novo-fornecedor.php" class="nav-link"> Novo Fornecedor </a> </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="item"> 
                        <a onclick="menuDespesa()">
                            <img src="assets/images/menu/despesa.png" alt="">
                        </a>
                        <nav id="submenuDespesa">
                            <ul class="nav flex-column">
                                <li class="nav-item"> <a href="despesas/despesas.php" class="nav-link"> Listar Lançamentos </a> </li>
                                <li class="nav-item"> <a href=".despesas/form-nova-despesa.php" class="nav-link"> Nova Despesa(Custo) </a> </li>
                                <li class="nav-item"> <a href="despesas/gerar-planilha.php" class="nav-link"> Gerar Relatório </a> </li>
                            </ul>
                        </nav>
                    </div> 
                    <div class="item">
                        <a onclick="menuPatrimonio()">
                            <img src="assets/images/menu/patrimonio.png" alt="">
                        </a>
                        <nav id="submenuPatrimonio">
                            <ul class="nav flex-column">
                                <li class="nav-item"> <a class="nav-link" href="patrimonio/patrimonio.php">Patrimônio</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="patrimonio/form-novo-patrimonio.php">Novo Patrimônio</a> </li>
                            </ul>
                        </nav>
                    </div>          
                    <div class="item">
                        <a href="sair.php">
                            <img src="assets/images/menu/sair.png" alt="">
                        </a>
                    </div>
                </div>                
            </div>
            <!-- finalizando menu lateral -->
            <!-- Tela com os dados -->
            <div class="tela-principal">
                <div class="menu-superior">
                   <div class="icone-menu-superior">
                        <img src="assets/images/icones/home.png" alt="">
                   </div>
                   <div class="title">
                        <h2>Bem-Vindo <?php echo $nomeUsuario ?></h2>
                   </div>
                </div>
                <!-- dados exclusivo da página-->
                <div class="menu-principal">
                    <div class="indices">
                        <div class="indice-area-title">
                            <div class="icone-indice">
                                <img src="assets/images/dados.png" alt="">
                            </div>
                            <div class="title-indice">
                                <p>INFOR GERAIS</p>
                            </div>
                        </div>
                    </div>
                    <div class="area-indice-val">
                        <div class="indice-ind">
                            <div class="indice-ind-tittle">
                                <p>Setores</p>
                            </div>
                            <div class="indice-qtde">
                                <img src="assets/images/icones/departamento.png" alt="">
                                <p class="qtde"> <?php echo $qtdSetor; ?> </p>
                            </div>
                        </div>
                        <div class="indice-ind">
                            <div class="indice-ind-tittle">
                                <p>Categorias</p>
                            </div>
                            <div class="indice-qtde">
                                <img src="assets/images/icones/categoria.png" alt="">
                                <p class="qtde"> <?php echo $qtdCategoria; ?> </p>
                            </div>
                        </div>
                        <div class="indice-ind">
                            <div class="indice-ind-tittle">
                                <p>Produto / Serviços</p>
                            </div>
                            <div class="indice-qtde">
                                <img src="assets/images/icones/produtos.png" alt="">
                                <p class="qtde"> <?php echo $qtdPecas; ?> </p>
                            </div>
                        </div>
                        <div class="indice-ind">
                            <div class="indice-ind-tittle">
                                <p>Lançamentos</p>
                            </div>
                            <div class="indice-qtde">
                                <img src="assets/images/icones/despesa.png" alt="">
                                <p class="qtde"> <?php echo $qtdLancamento; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="assets/js/jquery.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/menu.js"></script>
    </body>
</html>