$(document).ready(function(){
    /**
     * Função - Carregar calendário mostrando os eventos cadastrados
     * Libs - Fullcalendar + Datetimepicker
     */
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
                
                jQuery("#diasemana").val(dayselected.day());
                
                jQuery('#_data').val(date.format());
                jQuery('#data').val(date);

                var $strdata = date.format().split('T'); 
                var hora =  date.format().split('T')[1];
                var data = new Date();
                
                var dataAtual = (data.getFullYear() + '-' + (data.getMonth()+1) + '-' + data.getDate());

        },
		eventClick: function(event, jsEvent, view){            
            idagenda = event.idagenda;
           
            $.ajax({
				url: '../agendamentos/agenda.php',
                method: 'POST',
                dataType: 'json',
				data: {
                    tipoform: 'getEvento',
                    idagenda: idagenda									
				},
				success: function(evento){
                    evento = evento[0];
                    $('#up-idagenda').val(evento.idagenda);
                    $('#idpaciente').val(evento.paciente);
                    $('#paciente').val(evento.nome);
                    $('#medico').val(evento.medicoID);
                    $('#up-datareal').val(evento.dataconsulta);
                    
                    dtSalva = new Date(evento.dataconsulta);
                    
                    var hr = dtSalva.getHours();
                    var minute = dtSalva.getMinutes();
                    if(minute == '0') minute = '00'

                    var horas = [hr, minute].join(':');
                    var datahora = [dtSalva.getDate(), dtSalva.getMonth() + 1, dtSalva.getFullYear()].join('/');
                    
                    $("#datetimepicker").val(datahora + ' '+ horas);

                    //Formatar data usando Datetimepicker
                    jQuery.datetimepicker.setLocale('pt-BR');
                    $('#datetimepicker').datetimepicker({
                        pickTime: false
                    });
                    //Usar calendário Datetimepicker
                    $('#datetimepicker').blur(function(){
                        var dateVar = $(this).val();
                        var dataFormatada = new Date($(this).val());
                        
                        var hora = dataFormatada.getHours();
                        var minutos = dataFormatada.getMinutes();
                        if(minutos == '0') minutos = '00'

                        var hours = [hora, minutos].join(':');
                        var data = [dataFormatada.getDate(), dataFormatada.getMonth() + 1, dataFormatada.getFullYear()].join('/');

                        $("#up-datareal").val(dateVar);
                        $("#datetimepicker").val(data + ' '+ hours);
                    });
				}
			});
            $('#btnAbrirConsulta').click();
		},
		navLinks: true,   // can click day/week names to navigate views
		eventLimit: false, // allow "more" link when too many events
		editable: false,
		events: function(start, end, timezone, callback) { 
			$.ajax({
				url: '../agendamentos/agenda.php',
                method: 'POST',                
				data: {
                    tipoform: 'consultas'									
				},
				success: function(doc){
                events = jQuery.parseJSON(doc); 
                //retornar os eventos para o calendário
                callback(events);
                    				
				}
			});
		},
		});
	}

	load_calendar();//carregar o calendário
});