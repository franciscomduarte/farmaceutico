<?php 
require_once 'config.php';
$usuario = $_SESSION['usuario']; 
?>

<style>
    .overlay { }
    .overlay_1 { }
    
    /* Custom, iPhone Retina */ 
    @media only screen and (min-width : 320px) {
        .overlay_1 { display: none; }
    }

    /* Extra Small Devices, Phones */ 
    @media only screen and (min-width : 480px) {
        .overlay_1 { display: none; }
    }

    /* Small Devices, Tablets */
    @media only screen and (min-width : 768px) {
        .overlay_1 { display: none; }
    }

/*     /* Medium Devices, Desktops */ */
/*     @media only screen and (min-width : 992px) { */
/*         .overlay_1 { display: none; } */
/*     } */

    /* Large Devices, Wide Screens */
    @media only screen and (min-width : 1366px) {
        .overlay_1 { display: none; }   
    }
    
/*     @media only screen and (min-width: 768px){ */
/*         .overlay { display: none; } */
/*     } */
/*     @media only screen and (max-width: 768px){ */
/*         .overlay_1 { display: none; } */
/*     } */
</style>

<body class="top-navigation">


    <div id="wrapper">

        <nav class="navbar navbar-static-top" role="navigation">
            <div class="navbar-header">
                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <i class="fa fa-reorder"></i>
                </button>
                <div  style='z-index: 0;'><a href="/" class="navbar-brand overlay_1"><?php echo SIGLA_SISTEMA." - ".NOME_SISTEMA ?></a></div>
                <div style='z-index: 1;'>
                	<a href="/" class="navbar-brand overlay"><?php echo SIGLA_SISTEMA ?></a>
                	<a class="navbar-toggle overlay" type="button" href="/checklist-resposta"> Cadastrados </a>
                	<a class="navbar-toggle overlay" type="button" href="/paciente/novo"> Novo Cadastro </a>
                </div>
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
                    
                   <li class="dropdown">
                    	<a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Bundles <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                        	<li><a href="/checklist-resposta">Todos</a></li>
                        	<?php 
                        	
                            	$objChecklist = new Checklist();
                            	$bundles = $objChecklist->listarAtivosCount();
                            	foreach ($bundles as $bundle) {
                        	?>
                            	<li><a href="/checklist-resposta/<?php echo $bundle->id?>"><?php echo $bundle->sigla ?></a></li>
                            <?php 
                        		}
                            ?>
                        </ul>
                    </li>
                    
                    <li><a class="navbar-toggle overlay btn btn-outline btn-primary dim" type="button" href="/checklist-resposta" title="Cadastrados"><i class="fa fa-list-alt"></i> </a></li>
                	<li><a class="navbar-toggle overlay btn btn-outline btn-primary dim" type="button" href="/paciente/novo" title="Novo Cadastro"><i class="fa fa-plus"></i></a></li>
                    
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
