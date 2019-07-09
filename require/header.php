<nav class="navbar navbar-expand-lg navbar-dark nav-container">
	<a href="#" class="navbar-brand navbar-logo"><img src="../images/brand.png" alt="Restart Games"  id="brandNew"/></a></a>
	<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarMenu">	
		
		<ul class="navbar-nav ml-auto">
			<?php
				$user = Usuarios::getUsuario();
				if(!empty($user)):
					$emailLogado = $user->email;
					$usuario  = $user->nome;
                    $status = $user->tipousuario;
                    echo $status;
					if($status > 1):
            ?>
					<li class="menu nav-item"><a href="#" class="nav-link"> <i class="fa fa-bell"></i> Notificações</a></li>
					<!-- <li class="menu nav-item"><a href="users/dashboard.php" class="nav-link"> <i class="fa fa-home"></i></a></li> -->               
					<!-- <li class="menu nav-item"><a href="admin/admin.php" class="nav-link"> <i class="fa fa-home"></i></a></li> -->
                <?php endif; ?>                
                    <li class="menu nav-item" ><a href="#" class="nav-link" style="cursor:inherit"><i class="fa fa-user"></i> <?php echo $usuario;?></a></li>
					<li class="menu nav-item"><a href="sair.php" class="nav-link"><i class="fa fa-sign-out"></i> Sair</a></li>
			    <?php endif; ?>
		</ul>
	</div>            
</nav>