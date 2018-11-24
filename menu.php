<?php 
require_once 'config.php';
$usuario = $_SESSION['usuario']; 
?>

<body class="top-navigation">
    <div id="wrapper">

        <nav class="navbar navbar-static-top" role="navigation">
            <div class="navbar-header">
                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <i class="fa fa-reorder"></i>
                </button>
                <a href="/" class="navbar-brand"><?php echo SIGLA_SISTEMA." - ".NOME_SISTEMA?></a>
            </div>
            <div class="navbar-collapse collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a aria-expanded="false" role="button" href="/"> Bem-vindo(a), <?php echo $usuario['nome'] ?> </a>
                    </li>
                    
                    <?php 
                    
                    	$permissao = new Permissao();
                    	$idPerfilUsuario = $usuario['id_perfil'];
                    	$permissoesMenu = $permissao->montarMenuPorIdPerfilUsuario($idPerfilUsuario);
                    	
                    	foreach ($permissoesMenu as $p) {
                    ?>
	                   <li class="dropdown">
	                    	<a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $p['descricao'] ?> <span class="caret"></span></a>
	                        <ul role="menu" class="dropdown-menu">
	                        	<?php 
	                        	
	                        		$permissoesSubMenu = $permissao->montarSubMenuPorIdPerfilUsuario($idPerfilUsuario, $p['id']);
	                        		foreach ($permissoesSubMenu as $sp) {
	                        	?>
	                            	<li><a href="<?php echo verificarPermissaoComId($sp['url']) ?>"><?php echo $sp['descricao'] ?></a></li>
	                            <?php 
	                        		}
	                            ?>
	                        </ul>
	                    </li>
                    <?php 
                    	}
                    ?>
                    
                </ul>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="/login/sair"">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <div id="page-wrapper" class="gray-bg">
        <br>
