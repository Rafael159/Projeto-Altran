<?php
    spl_autoload_register(function($classe) {
        require('../classes/'.$classe.'.class.php');	
    });
    $notificacoes = new Notificacoes;
    $agenda = new Agendamentos;
    $medicos = new Medicos;
    
    $row = $notificacoes->getNotificacoes();//buscar todas as ações da parte do cliente

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
        
        <!-- Folhas de estilo/Bootstrap-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/fonts.css">        
        <link rel="stylesheet" href="../css/app.css">
		<link rel="stylesheet" href="../font-awesome/css/font-awesome.css">  
		
		<!-- Fullcalendar -->
		<link href="../css/fullcalendar/fullcalendar.min.css" rel='stylesheet' />
		<link href="../css/fullcalendar/fullcalendar.print.min.css" rel='stylesheet' media='print' />
		<link href="../css/fullcalendar/myfullcalendar.css" rel='stylesheet'/>

        <!-- Datatimepicker -->
		<link rel="stylesheet" type="text/css" href="../datetimepicker/jquery.datetimepicker.css" >

        <title>Dashboard Admin</title>
    </head>
    <body style="background:#ccc">
        <div class="container-fluid nopadding">
            <?php require_once('../require/header.php'); ?>

            <div class="row d-flex justify-content-center nopadding">
        		<div class='col-lg-12'>
                	<div id='calendar'><!--o calendário vem aqui--></div>
                </div>                
            </div>

            <div class="modal fade" id="news" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Notificação</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="news-content">
                        <div id="feed">                            
                            <?php                                
                                if(count($row) <= 0):
                            ?>
                            <span class="alert alert-info text-center" style="display:block">Nenhuma consulta agendada. Agende no formulário ao lado </span>
                            <?php else: ?>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tipo</th>
                                        <th>Mensagem</th>
                                        <th>Usuário</th>
                                        <th>Data da modificação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($row as $notifica => $news):
                                    ?>
                                    <tr>
                                        <td>#<?php echo $news->idnotifica?></td>
                                        <td><?php echo $news->tipo?></td>
                                        <td><?php echo $news->mensagem?></td>
                                        <td><?php echo $news->nome?></td>
                                        <td><?php echo date("d/m/Y H:i", strtotime($news->dataacao))?></td>
                                    </tr>
                                    <?php endforeach; ?>               
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
					</div>
					</div>
				</div>
            </div>
            
            <!--Modal para interagir com a consulta-->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showConsulta" id="btnAbrirConsulta" style="display:none">
				Abrir modal
			</button>
			<div class="modal fade" id="showConsulta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Consulta</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="admEditar">
											
						<form method="post" name="update-consulta" id="update-consulta" action="../agendamentos/agenda.php">
							<input type="hidden" name="tipoform" value="atualizar">
							<input type="hidden" name="idpaciente" id="idpaciente">
							<input type="hidden" name="up-idagenda" id="up-idagenda">
								
							<div class="form-group">
								<label for="paciente"><i class="fa fa-user"></i> Paciente</label>
								<input type="paciente" disabled="disabled" class="form-control" id="paciente" name="paciente" placeholder="Nome do paciente">
							</div>

							<div class="form-group">
								<label for="medico"><i class="fa fa-user-md"></i> Médico</label>
								<select class="form-control" id="medico" name="medico">
									<option value="">Selecione o médico</option>
									<?php foreach($medicos->getAgendamentos() as $m => $medico): ?>								
									<option value="<?php echo $medico->id?>"><?php echo $medico->medico?></option>
									<?php endforeach; ?>								
								</select>
							</div>

							<div class="form-group">
								<label for="dataconsulta"><i class="fa fa-calendar"></i> Data/Hora da consulta </label>
								<input type="text" class="form-control" id="datetimepicker" name="dataconsulta" placeholder="Data da consulta">
								<input type="hidden" class="form-control" id="up-datareal" name="up-datareal">								
							</div>

							<div class="box-error">
								<div class="alert alert-danger erros" role="alert">
									<!-- aqui virá as mensagens de erro -->
								</div>
                            </div>
							<button type="button" class="btn btn-danger" id="admDeletaConsulta">Deletar <i class="fa fa-trash"></i></button>                            
							<button type="button" class="btn btn-info" id="admBtnAtualizarConsulta">Atualizar <i class="fa fa-edit"></i></button>
						</form>
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
        <script src="../js/calendario.js" crossorigin="anonymous"></script>        
        <script src="../js/app.js" crossorigin="anonymous"></script>
        
		<!--Fullcalendar-->
		<script src="../fullcalendar/moment.min.js"></script>
		<script src="../fullcalendar/jqueryCalendar.min.js"></script>
		<script src="../fullcalendar/fullcalendar.min.js "></script>
        <script src="../fullcalendar/pt-br.js"></script>
        
        <!-- Datatimepicker -->
		<script src="../datetimepicker/build/jquery.datetimepicker.full.js"></script>
		<script src="../datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
		<script src="../datetimepicker/build/jquery.datetimepicker.min.js"></script>
		
        <script>
            $(document).ready(function(){
                /**Funções para desmarcar Consulta */
                $('#admDeletaConsulta').on('click', function(){
                    idagenda = $('#up-idagenda').val();
                    var x = confirm("Tem certeza que deseja desmarcar a consulta #"+idagenda+' ?');
                    if (x){
                        //enviar via ajax para ser deletado
                        $.ajax({
                            url: '../agendamentos/agenda.php',
                            method: 'POST',
                            dataType: 'json',               
                            data: {
                                tipoform: 'deletaEventoAdm',
                                idagenda: idagenda					
                            },
                            success: function(dados){
                                if(dados.status =="0"){
                                    alert(dados.mensagem);
                                }else{
                                    alert(dados.mensagem);                        
                                    window.location.reload();
                                }
                            }
                        });
                    }
                    else{
                        return false;
                    }
                });
                /**Fim das Funções para desmarcar Consulta */

                /**Funções para atualizar Consulta */
                $('#admBtnAtualizarConsulta').on('click', function(ev){
                    ev.preventDefault();
                    //informações do formulário
                    $form = $(this).parent();
                    $action = $form.attr('action');
                    $method = $form.attr('method');                    
                    executaFormulario($form, $action, $method, 'atualizar');
                });
                /**Fim das Funções para atualizar Consulta */
            });
        </script>
    </body>
</html>