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
            <div class="col-lg-12 ">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg nopadding">
                        <div id="box-sign-up" class="box-init">
                            <span class="box-title">Ainda não tem cadastro? Cadastre-se agora mesmo</span>
                            <form method="post" name="formcadastro">
                                <div class="form-group">
                                    <label for="cadnome">Nome</label>
                                    <input type="text" class="form-control" id="cadnome" placeholder="Nome completo" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="cademail">Email</label>
                                    <input type="email" class="form-control" id="cademail" placeholder="name@example.com" autocomplete="off">
								</div>
								<div class="form-group">
                                    <label for="cadpass">Password</label>
                                    <input type="password" class="form-control" id="cadpass" placeholder="Password" autocomplete="off">
                                </div>

								<label for="cadnome" style="display:block">Sexo</label>
                                <div class="form-check form-check-inline">									
                                    <input class="form-check-input" type="radio" name="cadsexo" id="option-man" value="m">
                                    <label class="form-check-label" for="option-man">Masculino</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="cadsexo" id="option-woman" value="f">
                                    <label class="form-check-label" for="option-woman">Feminino</label>
								</div>
								
								<div class="form-group">
                                    <label for="cadtelefone">Telefone</label>
                                    <input type="text" class="form-control" id="cadtelefone" placeholder="(99) 99999 - 9999" autocomplete="off">
								</div>
								
								<div class="form-group">
                                    <label for="cadcidade">Cidade</label>
                                    <input type="text" class="form-control" id="cadcidade" placeholder="Cidade" autocomplete="off">
                                </div>
                                <button type="button" class="btn btn-primary" id="btn-signup">Cadastrar <i class="fa fa-user-plus"></i></button>
                                
                            </form>
                        </div>
                    </div>
                    <div class="col-lg nopadding">
                        <div id="box-login" class="box-init">
                            <span class="box-title">Fazer login no sistema</span>

                            <form>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="js/app.js" crossorigin="anonymous"></script>

	</body>
</html>