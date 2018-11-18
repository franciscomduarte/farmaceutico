<?php
$usuarioLogado = $_SESSION ['usuario'];
$params = retornaParametrosUrl ( $_GET ['r'] );
$modulo = $params [0];

?>

<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-4">
		<h2><?php echo NOME_MODULO ?></h2>
		<ol class="breadcrumb">
			<li><a href="/">b2i</a></li>
			<li><a
				href="/<?php echo $modulo ?>/<?php echo $modulo == 'curriculo' ? $usuarioLogado['id'] : ''?>"><?php echo $modulo ?></a></li>
			<li><?php echo NOME_ACAO ?></li>
		</ol>
	</div>
</div>
<br>

