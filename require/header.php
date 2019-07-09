<nav class="navbar navbar-expand-lg navbar-dark nav-container">
	<a href="index.php" class="navbar-brand navbar-logo"><img src="imagens/icones/logo.png" alt="Restart Games"  id="brandNew"/></a></a>
	<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarMenu">		
		<form id="box_pesquisa" class='form-inline my-auto d-inline search-field' method="GET" action="pesquisa.php">
			<?php  
				$q = (isset($_GET['pesquisa']) AND !empty($_GET['pesquisa'])) ? $_GET['pesquisa'] : '';			
				if(isset($_GET['pag'])){
					$pag = $_GET['pag'];
					if($pag >= 2){
						$q = "";
					}
				}
			?>
			<div class="input_container">
				<div class="control-group">
					<input type="text" name="pesquisa" id="id_pesquisa" class="form-control border border-right-0 pesquisa" onkeyup="autoCompletar(this)" autocomplete="off" value="<?php if(isset($q)){echo $q;}else{}?>"/>
					<button type="submit" name="enviar" class="search-btn">Pesquisar</button>
				</div>
				<ul id="opcao_jogo"></ul>
			</div>
		</form>
		<ul class="navbar-nav ml-auto">
			<?php
				$user = Usuarios::getUsuario();
				
				if(!empty($user)):
					$emailLogado = $user->emailTJ;
					$usuario  = $user->nomeUser;
					$status = $user->tipousuario;
					if($status == 0):
			?>
					<li class="logado nav-item"><a href="users/dashboard.php" class="nav-link"> <i class="fa fa-home"></i></a></li>
				<?php else: ?>
					<li class="logado nav-item"><a href="admin/admin.php" class="nav-link"> <i class="fa fa-home"></i></a></li>
				<?php endif; ?>
					<li class="logado nav-item"><a href="#" class="nav-link"><?php echo $usuario;?></a></li>
					<li class="logado nav-item"><a href="sair.php" class="nav-link">Sair <i class="fa fa-sign-out"></i></a></li>
			<?php else: ?>
				<li class="logado  nav-item access-login" id="user-entrar"><a href="#" class="nav-link"><i class="fa fa-sign-in" aria-hidden="true"></i> Entrar </a></li>
				<li class="logado nav-item access-register" id="user-cadastrar"><a href="#" class="nav-link"><i class="fa fa-user-plus" aria-hidden="true"></i> Criar conta</a></li>
			<?php endif; ?>
		</ul>
	</div>            
</nav>