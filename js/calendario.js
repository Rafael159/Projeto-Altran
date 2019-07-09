$(document).ready(function(){
    function load_calendar(){
		
		$('#calendar').fullCalendar({
            locale: 'pt-br',	
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			ignoreTimezone: false,
			monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
			monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
			dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
			dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
			slotDuration: '00:30:00',
			slotLabelInterval: 30,
			slotLabelFormat: 'H(:mm)',
			eventLimit: true,
			minTime: '9:00',
			maxTime: '15:00',
			timeFormat: 'H(:mm)',
			defaultTimedEventDuration : '00:30:00', 
			buttonText: {
				today: "Hoje",
				month: "Mês",
				week: "Semana",
				day: "Dia",
			},
            dayClick: function(date, jsEvent, view){
                var dayselected = moment(date.format());
                // console.log(dayselected);
                jQuery("#diasemana").val(dayselected.day());
                //   zeraformulario();
                //   setsalasclinicas('','');

                jQuery('#_data').val(date.format());
                jQuery('#data').val(date);

                var $strdata = date.format().split('T'); 
                var hora =  date.format().split('T')[1];
                var data = new Date();
                
                var dataAtual = (data.getFullYear() + '-' + (data.getMonth()+1) + '-' + data.getDate());
                
            // if(tipoperfil=='geral' && $strdata.length > 1){
                
            //     $("#boxredireciona").fadeOut();
            //     jQuery('#exampleModal').modal('show');

            //     if($strdata.length == 1){
            //     $hora = "Agendamento Diário";
            //     document.getElementById('str_hora').innerHTML = $hora;
                
            //     }else{
            //     $hora = date.format().split('T')[1];
            //     document.getElementById('str_hora').innerHTML = $hora;
            //     }
            
            //     document.getElementById('str_data').innerHTML = dataconvert($strdata[0]);
                
            //     $('#pacx').append("<option value='10'>teste</option>");

            //     $('#footer').html('');
            //     if( !((date < moment()) && (!(moment().format('YYYY-MM-DD') == date.format('YYYY-MM-DD')))) ){
            //     $('#footer').append("<button type='button' class='btn btn-success' onclick='salva()'>Salvar</button>");
            //     $('#footer').append("<button type='button' class='btn btn-danger'  onclick='exclui()' data-dismiss='modal'>Excluir</button>");
            //     }else{
            //     $('#alerta').css('display','block').animate({opacity: 1});
            //     $('#alerta').html('Agendamentos Indisponíveis para datas anteriores');
            //     }
            //     $('#footer').append("<button type='button' class='btn btn-primary' data-dismiss='modal'>Fechar</button>");
            // }
        },
		eventClick: function(calEvent, jsEvent, view){
			$("#boxredireciona").fadeOut();
     
			$.ajax({
			url: 'eventos/xeventosdetalhes',
			Type: 'GET',
			data: {
				id: calEvent.obs
			},
			success: function(doc){					
                result = JSON.parse(doc);
                evento = result.dados;
                ficha = result.ficha;                        
                    if(evento){
                        $("#boxredireciona").fadeIn();
                    }

                    document.getElementById('str_data').innerHTML = dataconvert(evento.dataconsulta);
                    document.getElementById('str_hora').innerHTML = retornahorario(evento.startconsulta, evento.endconsulta);
                
                var href='';

                if(evento.status === "finalizado"){
                    href = '/medicos/medicofichaclinica/'+ficha.id;
                }else{
                    href = '/medicos/medicofichaclinica/'+ficha.id+'/'+evento.id;
                }
                
                    $('#redireciona').removeAttr('href');
                    $('#redireciona').attr('href', href);

                    $('#alerta').css('display','none');
                    $('#alerta').html('');
                    $('[name=atividade]').val(evento.atividade);
                    $('[name=obs]').val(evento.obs);
            
                    //$('[name=medico] option').eq(evento.medico).prop('selected', true);
                    $('[name=medico]').val(evento.medico);
                    $('[name=paciente]').val(evento.paciente);
                
                    $('[name=status]').val(evento.status);
                    $('[name=clinica]').val(evento.idclinica);

                    setespecialidades(evento.medico);
                    setsalasclinicas(evento.idclinica,evento.sala);

                    $('#footer').html(''); 
                    $('#footer').append("<input id='calevent' type='hidden' value='" + calEvent._id + "' >");
                    $('#footer').append("<input id='idagendamento' type='hidden' value='" + calEvent.obs + "' >");
                    
                    if(!(evento.status == 'finalizado')){
                        if(tipoperfil!=='Médico'){
                            $('#footer').append("<button type='button' class='btn btn-success' onclick='edita()'>Editar</button>");
                            $('#footer').append("<button type='button' class='btn btn-danger'  onclick='exclui()' data-dismiss='modal'>Excluir</button>");
                        }
                }
				$('#footer').append("<button type='button' class='btn btn-primary' data-dismiss='modal'>Fechar</button>");
				
				jQuery('#exampleModal').modal('show');
			}
			});
		},
		navLinks: true,   // can click day/week names to navigate views
		eventLimit: false, // allow "more" link when too many events
		editable: false,
		events: function(start, end, timezone, callback) {
      
			//var filtros = [];
			// salas = getSalas();
			// medicos = getMedicos();
			// grupoStatus = getStatus();
			
			$.ajax({
				url: 'eventos/xeventos',
				type: 'GET',
				data: {
					// salas : salas,
					// status: grupoStatus,
					// medicos : medicos					
				},
				success: function(doc){
				events = JSON.parse(doc);          
				callback(events);
				
				}
			});
		},
		});
	}

	load_calendar();
});