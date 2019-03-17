<!DOCTYPE html>
<html>
<?php require_once 'config.php';?>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="Description" content="Sistema de Monitoramento de Checklists">

    <title><?php echo SIGLA_SISTEMA?> | Login</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown" style="padding-top: 10px">
        <div>
            <div>
                <h1 class="logo-name" style="font-size: 90px; color: #727279"><?php echo SIGLA_SISTEMA?></h1>
            </div>
            <p><?php echo NOME_SISTEMA?></p>
            <?php 
				if (isset($_REQUEST['erro'])) {
					echo "<center>";
					if ($_REQUEST['erro'] == 1){
						echo '<div class="alert alert-danger" align="center">Usuário os senha inválidos, tente novamente.</div>';
					} elseif ($_REQUEST['erro'] == 2) {
						echo '<div class="alert alert-warning"  align="center">Sua sess&atilde;o expirou, acesse novamente.</div>';
					}
					echo "</center>";
			     }
			     
			     if (isset($_REQUEST['mensagem'])) {
			     	echo "<center>";
			     	echo '<div class="alert alert-success" align="center">Cadastro realizado com sucesso. Use o e-mail e a senha cadastrada para acessar o sistema.</div>';
			     	echo "</center>";
			     }
		     ?>
            
            <form class="m-t" role="form" action="acessar.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Usuário de email" required name="usuario">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Senha" required name="senha">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
<!--                 <a class="btn btn-info block full-width m-b" href="/cadastreSe.php">Cadastre-se<small> - Para usuários externos</small></a> -->
<!--                 <small><b>Usuários internos:</b> Use o login e senha de rede.</small> -->
                <small>Use o e- mail e senha cadastrados.</small>
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

</body>
</html>