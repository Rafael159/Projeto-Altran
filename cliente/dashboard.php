<?php
	date_default_timezone_set('America/Sao_Paulo');

    spl_autoload_register(function($classe) {
        require('../classes/'.$classe.'.class.php');	
	});
	$agenda = new Agendamentos;
	$medicos = new Medicos;
	$user = Usuarios::getUsuario();
	
    if($user){
		$usuario = ($user->nome) ? $user->nome : '';
		$idpaciente = ($user->id) ? $user->id : '';
	}else{
		header('Location: ../index.php');
	}
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Sistema de agendamento de consultas"/>		
        <meta name="keywords" content="sistema, agendamento, consultas, médico, consultório"/>
		
		<!-- Bootstrap e folhas de estilo -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/fonts.css">        
        <link rel="stylesheet" href="../css/app.css">
		<link rel="stylesheet" href="../font-awesome/css/font-awesome.css">  
		
		<!-- Fullcalendar -->
		<link href="../css/fullcalendar/fullcalendar.min.css" rel='stylesheet' />
		<link href="../css/fullcalendar/fullcalendar.print.min.css" rel='stylesheet' media='print' />
		<link href="../css/fullcalendar/myfullcalendar.css" rel='stylesheet'/>
		
		<!-- Datapicker -->
		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css"> -->
		<!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" /> -->

        <title>Dashboard Cliente</title>
    </head>
    <body style="background:#ccc">
        <div class="container-fluid nopadding">
            <?php require_once('../require/header.php'); ?>

            <div id="box-principal">
                <div class="row d-flex justify-content-center nopadding">
                    <div class="col-lg-5">
                        <div class="schedule" id="form-consulta">
                            <span class="box-title">Adicionar consulta</span>
                            <form method="post" name="form-consulta" id="form-consulta" action="../agendamentos/agenda.php">
								<input type="hidden" name="tipoform" value="inserir">
								<input type="hidden" name="idpaciente" value="<?php echo $idpaciente; ?>">
                                    
                            	<div class="form-group">
                                    <label for="paciente"><i class="fa fa-user"></i> Paciente</label>
                                    <input type="paciente" disabled="disabled" class="form-control" id="paciente" name="paciente" placeholder="Nome do paciente" value="<?php echo $usuario?>">
                                </div>

								<div class="form-group">
									<label for="select-medico"><i class="fa fa-user-md"></i> Médico</label>
									<select class="form-control" id="select-medico" name="medico">
										<option value="">Selecione o médico</option>
										<?php foreach($medicos->getAgendamentos() as $m => $medico): ?>								
										<option value="<?php echo $medico->id?>"><?php echo $medico->medico?></option>
										<?php endforeach; ?>								
									</select>
								</div>

								<div class="form-group">
									<label for="dataconsulta"><i class="fa fa-calendar"></i> Data/Hora da consulta </label>
									<input type="text" class="form-control" id="dataconsulta" name="dataconsulta" placeholder="Data da consulta" disabled>
									<input type="hidden" class="form-control" id="datareal" name="datareal">
									<div id='calendar'><!--o calendário vem aqui--></div>
								</div>

                                <div class="box-error">
                                    <div class="alert alert-danger erros" role="alert">
                                        <!-- aqui virá as mensagens de erro -->
                                    </div>
                                </div>
                                <button type="button" class="btn btn-info" id="agendarconsulta">Agendar consulta <i class="fa fa-plus"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="schedule" id="consultas">
							<span class="box-title">Agendamentos</span>
							<?php
								$minhaagenda = $agenda->getAgendamentos(array('paciente'=>$user->id));
								if(count($minhaagenda) <= 0):
							?>
							<span class="alert alert-info text-center" style="display:block">Nenhuma consulta agendada. Agende no formulário ao lado </span>
							<?php else: ?>
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Paciente</th>
										<th>Médico</th>
										<th>Data da Consulta</th>
										<th>Ações</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach($minhaagenda as $ag => $evento):
									?>
									<tr>
										<td>#<?php echo $evento->idagenda?></td>
										<td><?php echo $evento->nome?></td>
										<td><?php echo $evento->medico?></td>
										<td><?php echo date("d/m/Y H:i", strtotime($evento->dataconsulta))?></td>
										<td>
											<button class="btn btn-info"><i class="fa fa-eye"></i></button>
											<button class="btn btn-danger" onclick="desmarcarConsulta(<?php echo $evento->idagenda ?>)"><i class="fa fa-remove"></i></button>
										</td>
									</tr>
									<?php endforeach; ?>               
								</tbody>
							</table>
							<?php endif; ?>
                        </div>
                    </div>
                </div>
			</div>

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
		<!-- <script src="http://code.jquery.com/jquery-1.8.2.js"></script> -->

		<script language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>

		<!-- <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script> -->
		<!-- <script src="../js/calendario.js" crossorigin="anonymous"></script> -->
		<script src="../js/dashboard.client.js" crossorigin="anonymous"></script>
		
		<script>
		$(document).ready(function(){			
			/**
			 * Função que busca e popular as options dos médicos
			 * Os médicos foram cadastrados manualmente em um arquivo .json
			 */
			// $.ajax({				
			// 	url: '../medicos/medicos.json',
			// 	dataType:'json',		
			// 	success: function(dados){					
			// 		$.each(dados, function( index, value ) {
			// 			//populando select
			// 			$('#select-medico').append('<option value='+value.id+'>' + value.nome + '</option>');
			// 		});
			// 	}
			// });
		});
		</script>
    </body>
</html>