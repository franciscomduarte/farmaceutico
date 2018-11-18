<?php
$params = retornaParametrosUrl ( $_GET ['r'] );
$id = $params [2];

$obj = null;
if ($id) {
	$usuario = new Usuario ();
	$obj = $usuario->listarPorId ($id);
}

?>

<div class="col-lg-12">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>
				Cadastro de Usuarios<small></small>
			</h5>
		</div>
		<div class="ibox-content">
			<div class="row">

				<form role="form" action="/usuario/gravar" method="post">
					<input type="hidden" name="id"
						value="<?php echo $obj['id'] ? $obj['id'] : null ?>">
					<div class="form-group col-xs-12 m-sm">

						<div class="form-group col-xs-6">
							<div class="form-group">
								<label>Nome</label> <input type="text"
									value="<?php echo $obj['nome'] ? $obj['nome'] : null ?>"
									placeholder="Insira o nome" class="form-control" name="nome"
									required="required">
							</div>
						</div>

						<div class="form-group col-xs-6">
							<div class="form-group">
								<label>Email</label> <input type="email"
									value="<?php echo $obj['email'] ? $obj['email'] : null ?>"
									placeholder="Insira o email" class="form-control" name="email"
									required="required">
							</div>
						</div>

						<div class="form-group col-xs-6">
							<div class="form-group">
								<label>Senha</label> <input type="password"
									value="<?php echo $obj['senha'] ? $obj['senha'] : null ?>"
									placeholder="Insira a senha" class="form-control" name="senha"
									required="required">
							</div>
						</div>

						<div class="form-group col-xs-6">
							<div class="form-group">
								<label>Perfil</label>
								
								<select name="perfil"
								class="select2_demo_2 form-control select2-hidden-accessible">
								<option value="">-- Selecione --</option>
								<?php
								$perfil = new Perfil();
								$listaPerfil = $perfil->listar ();
								foreach ( $listaPerfil as $perfil) {
									?>
									<option value="<?php echo $perfil['id'] ?>" <?php echo ($obj['id_perfil'] == $perfil['id'] ? 'selected="selected"' : '')?>> <?php echo $perfil['descricao']?> </option>
								<?php
								}
								?>
	                    		</select>
								
							</div>
						</div>

						<div class="form-group col-xs-4">
							<div class="form-group">
								<label>CPF</label> <input type="text"
									value="<?php echo $obj['cpf'] ? $obj['cpf'] : null ?>"
									placeholder="Insira o CPF" class="form-control" name="cpf"
									required="required" data-mask="999.999.999-99">
							</div>
						</div>

						<div class="form-group col-xs-4 ">
							<div class="form-group">
								<label>SIAPE</label> <input type="text"
									value="<?php echo $obj['siape'] ? $obj['siape'] : null ?>"
									placeholder="Insira o SIAPE" class="form-control" name="siape"
									required="required" data-mask="9999999">
							</div>
						</div>
						
						<div class="form-group col-xs-4">
							<div class="form-group">
								<label>RG</label> <input type="text"
									value="<?php echo $obj['rg'] ? $obj['rg'] : null ?>"
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
										value="<?php echo $obj['nascimento'] ? $obj['nascimento'] : null ?>"
										class="form-control" name="nascimento" required="required">
								</div>
							</div>
						</div>
						
						<div class="form-group col-xs-4">
							<div class="form-group">
								<label>Endereço</label> <input type="text"
									value="<?php echo $obj['endereco'] ? $obj['endereco'] : null ?>"
									placeholder="Insira o endereço" class="form-control"
									name="endereco" required="required">
							</div>
						</div>

						<div class="form-group col-xs-4 ">
							<div class="form-group">
								<label>Munícipio</label> <input type="text"
									value="<?php echo $obj['municipio'] ? $obj['municipio'] : null ?>"
									placeholder="Insira o município" class="form-control"
									name="municipio" required="required">
							</div>
						</div>
						
						<div class="form-group col-xs-4">
							<div class="form-group">
								<label>CEP</label> <input type="text"
									value="<?php echo $obj['cep'] ? $obj['cep'] : null ?>"
									placeholder="Insira o cep" class="form-control" name="cep"
									required="required" data-mask="99.999-999">
							</div>
						</div>

						<div class="form-group col-xs-4 ">
							<div class="form-group">
								<label>Telefone</label> <input type="text"
									value="<?php echo $obj['telefone'] ? $obj['telefone'] : null ?>"
									placeholder="Insira o telefone" class="form-control"
									name="telefone" required="required" data-mask="(99) 99999-9999">
							</div>
						</div>
						
						<div class="form-group col-xs-4">
							<div class="form-group">
								<label>Cargo</label> <input type="text"
									value="<?php echo $obj['cargo'] ? $obj['cargo'] : null ?>"
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
								$uf = new Uf();
								$listaUf = $uf->listar();
								foreach ($listaUf as $uf) {
									?>
									<option value="<?php echo $uf['id'] ?>" <?php echo ($obj['uf_id'] == $uf['id'] ? 'selected="selected"' : '')?>> <?php echo $uf['descricao'] ?> </option>
									<?php
								}
								?>
	                    		</select>
						</div>

						<div class="form-group col-xs-3 ">
							<p>
								<label>Lotação</label>
							</p>
							<select name="lotacao_id"
								class="select2_demo_2 form-control select2-hidden-accessible">
								<option value="">-- Selecione --</option>
								<?php
								$lotacao = new Lotacao ();
								$listaLotacao = $lotacao->listar ();
								foreach ( $listaLotacao as $lotacao ) {
									?>
									<option value="<?php echo $lotacao['id'] ?>" <?php echo ($obj['lotacao_id'] == $lotacao['id'] ? 'selected="selected"' : '')?>><?php echo $lotacao['nome']?> </option>
								<?php
								}
								?>
	                    		</select>
						</div>

						<div class="form-group col-xs-4 ">
							<p>
								<label>Status</label>
							</p>
							<div class="radio radio-info radio-inline">
								<input type="radio" id="ativo" value="1" name="ativo"
									<?php echo $obj['ativo'] ? "checked" : ""?>> <label for="ativo">
									Ativo </label>
							</div>

							<div class="radio radio-inline">
								<input type="radio" id="inativo" value="0" name="ativo"
									<?php echo !$obj['ativo'] ? "checked" : ""?>> <label
									for="inativo"> Inativo </label>
							</div>
						</div>

						<div class="form-group col-xs-12 ">
							<div>
								<button class="btn btn-white" type="button"
									onclick="history.go(-1);">Cancelar</button>
								<button class="btn btn-primary" type="submit">Salvar</button>
							</div>
						</div>
						
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
