<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Sistema de agendamento de consultas"/>		
        <meta name="keywords" content="login, cadastro, sistema, agendamento, consultas, médico, consultório"/>
        
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="css/fonts.css">        
        <link rel="stylesheet" href="font-awesome/css/font-awesome.css">        
        <link rel="stylesheet" href="css/app.css">
        <title>Crie sua conta ou cadastre-se</title>
    </head>
    <body>
        <div class="container-fluid nopadding">
			<!--Modal usado para alguns alertas-->
			<div class="modal fade" id="caixaAlerta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="caixaAlertaTitle">Notificação</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="caixa-mensagem">
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
					</div>
					</div>
				</div>
			</div>

            <div class="col-lg-12 ">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg nopadding">
                        <div id="box-sign-up" class="box-init">
                            <span class="box-title">Ainda não tem cadastro? Cadastre-se agora mesmo</span>
                            <form method="post" name="formcadastro" id="form-signup" action="user/signup.php">
                                <div class="form-group">
                                    <label for="cadnome">Nome</label>
                                    <input type="text" class="form-control" id="cadnome" name="nome" placeholder="Nome completo" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="cademail">Email</label>
                                    <input type="email" class="form-control" id="cademail" name="email" placeholder="name@example.com" autocomplete="off">
								</div>
								<div class="form-group">
                                    <label for="cadpass">Password</label>
                                    <input type="password" class="form-control" id="cadpass" name="senha" placeholder="Password" autocomplete="off">
                                </div>
								<div class="form-group">
									<label for="cadTipoUsuario">Tipo de usuário</label>
									<select class="form-control" id="cadTipoUsuario" name="tipousuario">
									<option value="">Selecione o tipo de usuário</option>
									<option value="1">Cliente</option>
									<option value="2">Atendente</option>
									<option value="3">Médico</option>									
									</select>
								</div>
								<label for="cadnome" style="display:block">Sexo</label>
                                <div class="form-check form-check-inline">									
                                    <input class="form-check-input" type="radio" name="sexo" id="option-man" value="m">
                                    <label class="form-check-label" for="option-man">Masculino</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sexo" id="option-woman" value="f">
                                    <label class="form-check-label" for="option-woman">Feminino</label><br>
								</div>
								
								<div class="form-group">
                                    <label for="cadtelefone">Telefone</label>
                                    <input type="text" class="form-control" id="cadtelefone" name="telefone" placeholder="(99) 99999 - 9999" autocomplete="off">
								</div>
								
								<div class="form-group">
                                    <label for="cadcidade">Cidade</label>
                                    <input type="text" class="form-control" id="cadcidade" name="cidade" placeholder="Cidade" autocomplete="off">
								</div>
								<div class="box-error">
									<div class="alert alert-danger erros" role="alert">
										<!-- aqui virá as mensagens de erro -->
									</div>
								</div>
                                <button type="button" class="btn btn-primary" id="btn-signup">Cadastrar <i class="fa fa-user-plus"></i></button>                                
                            </form>
                        </div>
                    </div>
                    <div class="col-lg nopadding">
                        <div id="box-login" class="box-init">
                            <span class="box-title">Fazer login no sistema</span>

                            <form method="post" name="formlogin" id="form-signin" action="user/login.php">
                                <div class="form-group">
                                    <label for="loginEmail" style="color:#fff">Email</label>
                                    <input type="email" class="form-control" id="loginEmail" name="email" aria-describedby="emailHelp" placeholder="Insira o email">
                                    <small id="emailHelp" class="form-text " style="color:#fff">Nunca passaremos o seu email para ninguém</small>
                                </div>
                                <div class="form-group">
                                    <label for="loginPassword" style="color:#fff">Password</label>
                                    <input type="password" class="form-control" id="loginPassword" name="senha" placeholder="Password">
                                </div>
                                <div class="box-error">
									<div class="alert alert-danger erros" role="alert">
										<!-- aqui virá as mensagens de erro -->
									</div>
								</div>
                                <button type="button" class="btn btn-success" id="btn-signin">Submit <i class="fa fa-sign-in"></i></button>
                            </form>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>

		<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
		<script src="js/jquery.js"></script>		
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="js/app.js" crossorigin="anonymous"></script>
        <script src="js/jquery.mask.js" crossorigin="anonymous"></script>

	</body>
</html>