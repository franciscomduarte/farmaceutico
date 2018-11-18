
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>b2i | Login</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

</head>
<div class="col-lg-12">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>
				Meu Cadastro<small></small>
			</h5>
		</div>
		<div class="ibox-content">
			<div class="row">

				<form role="form" action="/modulos/usuario/gravarExterno.php" method="post">
					<div class="form-group col-xs-12 m-sm">

						<div class="form-group col-xs-6">
							<div class="form-group">
								<label>Nome</label> <input type="text"
									value=""
									placeholder="Insira o nome" class="form-control" name="nome"
									required="required">
							</div>
						</div>

						<div class="form-group col-xs-6">
							<div class="form-group">
								<label>Email</label> <input type="email"
									value=""
									placeholder="Insira o email" class="form-control" name="email"
									required="required">
							</div>
						</div>

						<div class="form-group col-xs-6">
							<div class="form-group">
								<label>Senha</label> <input type="password"
									value=""
									placeholder="Insira a senha" class="form-control" name="senha"
									required="required">
							</div>
						</div>

						<div class="form-group col-xs-4">
							<div class="form-group">
								<label>CPF</label> <input type="text"
									value=""
									placeholder="Insira o CPF" class="form-control" name="cpf"
									required="required" data-mask="999.999.999-99">
							</div>
						</div>

						<div class="form-group col-xs-4 ">
							<div class="form-group">
								<label>SIAPE</label> <input type="text"
									value=""
									placeholder="Insira o SIAPE" class="form-control" name="siape"
									required="required" data-mask="9999999">
							</div>
						</div>
						
						<div class="form-group col-xs-4">
							<div class="form-group">
								<label>RG</label> <input type="text"
									value=""
									placeholder="Insira o RG" class="form-control" name="rg"
									required="required">
							</div>
						</div>

						<div class="form-group col-xs-4 ">
							<div class="form-group">
								<label>Nascimento</label>
								<div class="input-group date">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="date"
										value=""
										class="form-control" name="nascimento" required="required">
								</div>
							</div>
						</div>
						
						<div class="form-group col-xs-4">
							<div class="form-group">
								<label>Endereço</label> <input type="text"
									value=""
									placeholder="Insira o endereço" class="form-control"
									name="endereco" required="required">
							</div>
						</div>

						<div class="form-group col-xs-4 ">
							<div class="form-group">
								<label>Munícipio</label> <input type="text"
									value=""
									placeholder="Insira o município" class="form-control"
									name="municipio" required="required">
							</div>
						</div>
						
						<div class="form-group col-xs-4">
							<div class="form-group">
								<label>CEP</label> <input type="text"
									value=""
									placeholder="Insira o cep" class="form-control" name="cep"
									required="required" data-mask="99.999-999">
							</div>
						</div>

						<div class="form-group col-xs-4 ">
							<div class="form-group">
								<label>Telefone</label> <input type="text"
									value=""
									placeholder="Insira o telefone" class="form-control"
									name="telefone" required="required" data-mask="(99) 99999-9999">
							</div>
						</div>
						
						<div class="form-group col-xs-4">
							<div class="form-group">
								<label>Cargo</label> <input type="text"
									value=""
									placeholder="Insira o cargo" class="form-control" name="cargo"
									required="required">
							</div>
						</div>

						<div class="form-group col-xs-3 ">
							<p>
								<label>UF</label>
							</p>
							<select name="uf_id"
								class="select2_demo_2 form-control select2-hidden-accessible">
								<option value="">-- Selecione --</option>
								<?php
								
								include 'config.php';
								include 'util/functions.php';
								include 'classes/Uf.php';
								
								$uf = new Uf ();
								$listaUf = $uf->listar ();
								foreach ( $listaUf as $uf ) {
 									?>
									<option value="<?php echo $uf['id'] ?>"> <?php echo $uf['descricao'] ?> </option>
								<?php
 								}
 								?>
	                    		</select>
						</div>

						<div class="form-group col-xs-12 ">
							<div>
								<button class="btn btn-white" type="button"
									onclick="history.go(-1);">Cancelar</button>
								<button class="btn btn-primary" type="submit">Cadastrar</button>
							</div>
						</div>
						
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

    <!-- Mainly scripts -->
    <script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

</body>
<?php include 'footer.php';?>

</html>
