<?php
    spl_autoload_register(function($classe) {
        require('../classes/'.$classe.'.class.php');	
    });
    $user = Usuarios::getUsuario();
    if($user){
        $usuario = ($user->nome) ? $user->nome : '';
	} 

?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Sistema de agendamento de consultas"/>		
        <meta name="keywords" content="sistema, agendamento, consultas, médico, consultório"/>
        
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/fonts.css">        
        <link rel="stylesheet" href="../css/app.css">
		<link rel="stylesheet" href="../font-awesome/css/font-awesome.css">  
		
		<!-- Fullcalendar -->
		<link href="../css/fullcalendar/fullcalendar.min.css" rel='stylesheet' />
		<link href="../css/fullcalendar/fullcalendar.print.min.css" rel='stylesheet' media='print' />
		<link href="../css/fullcalendar/myfullcalendar.css" rel='stylesheet'/>

        <title>Dashboard Cliente</title>
    </head>
    <body style="background:#ccc">
        <div class="container-fluid nopadding">
            <?php require_once('../require/header.php'); ?>

            <div id="box-principal">
                <div class="row d-flex justify-content-center nopadding">
                    <div class="col-lg-4">
                        <div id="form-consulta">
                            <span class="box-title">Adicionar consulta</span>
                            <form method="post" name="form-consulta" id="form-consulta" action="consulta.php">
                                    
                            	<div class="form-group">
                                    <label for="loginPaciente">Paciente</label>
                                    <input type="paciente" class="form-control" id="paciente" name="paciente" placeholder="Nome do paciente" value="<?php echo $usuario?>">
                                </div>

								<div class="form-group">
									<label for="medico">Médico</label>
									<select class="form-control" id="select-medico" name="medico">
										<option value="">Selecione o médico</option>								
									</select>
								</div>

								<div class="form-group">
									<label for="medico">Data/Hora da consulta</label>
									<input type="dataconsulta" class="form-control" id="dataconsulta" name="dataconsulta" placeholder="Data da consulta" >
								</div>

                                <div class="box-error">
                                    <div class="alert alert-danger erros" role="alert">
                                        <!-- aqui virá as mensagens de erro -->
                                    </div>
                                </div>
                                <button type="button" class="btn btn-info" id="btn-signin">Agendar consulta <i class="fa fa-plus"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div id="consultas">
							<span class="box-title">Agendamentos</span>
							
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Paciente</th>
										<th>Médico</th>
										<th>Data Consulta</th>
										<th>Ação</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>#1</td>
										<td>Rafael</td>
										<td>Marcos</td>
										<td>14/09/2019</td>
										<td>
											<button class="btn btn-info"><i class="fa fa-eye"></i></button>
											<button class="btn btn-danger">Desmarcar <i class="fa fa-trash"></i></button>
										</td>
									</tr>                
								</tbody>
							</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="../js/jquery.js"></script>		
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="../js/app.js" crossorigin="anonymous"></script>
        <!-- <script src="../js/jquery.mask.js" crossorigin="anonymous"></script> -->
		
		<script src="../fullcalendar/moment.min.js"></script>
		<script src="../fullcalendar/jqueryCalendar.min.js"></script>
		<script src="../fullcalendar/fullcalendar.min.js "></script>
		<script src="../fullcalendar/pt-br.js"></script>
		
		<!-- <script src="../fullcalendar/fullcalendar.min.js" crossorigin="anonymous"></script> -->
		<script src="../js/calendario.js" crossorigin="anonymous"></script>
		
		<script>
		$(document).ready(function(){
			$.ajax({				
				url: '../medicos/medicos.json',
				dataType:'json',		
				success: function(dados){
					$.each(dados, function( index, value ) {
						console.log(index, value.nome);
						$('#select-medico').append('<option value='+index+'>' + value.nome + '</option>');
					});
				}
			});
		});
		</script>
    </body>
</html>