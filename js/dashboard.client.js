$(document).ready(function(){
    function load_calendar(){
		
		$('#calendar').fullCalendar({
            locale: 'pt-br',	
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'agendaWeek,agendaDay'
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
            defaultView:'agendaDay',
            defaultTimedEventDuration : '00:30:00', 
            validRange:{
                start: new Date().toISOString().substring(0,10)
            },
			buttonText: {
				today: "Hoje",
				month: "Mês",
				week: "Semana",
				day: "Dia",
			},
            dayClick: function(date, jsEvent, view){
                // Remove a classe do dia selecionado
                $('.fc-bg > table > tbody > tr > td').removeClass('diaselecionado');

                // Adiciona a classe "selecionado" ao dia clicado
                $(this).addClass('diaselecionado');

                var dayselected = moment(date.format());//pegar e formatar data clicada
                // console.log(dayselected);
                // jQuery("#diasemana").val(dayselected.day());
                //   zeraformulario();
                //   setsalasclinicas('','');

                //jQuery('#data').val(date);

                var $strdata = date.format().split('T'); 
                var hora =  date.format().split('T')[1];
                var data = new Date();
                if(typeof hora === 'undefined'){
                    jQuery('#dataconsulta').val(date.format('L'));//enviar para o formulário a data                    
                }else{
                    jQuery('#dataconsulta').val(date.format('L') + ' ' + hora);//enviar para o formulário a data
                }

                jQuery('#datareal').val(date.format());//enviar para o formulário a data
                
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
				url: '../agendamentos/agenda.php',
                method: 'POST',
                // dataType: 'json',
				data: {
                    tipoform: 'consultaindividual'
					// salas : salas,
					// status: grupoStatus,
					// medicos : medicos					
				},
				success: function(doc){
				events = jQuery.parseJSON(doc);       
                    
                // $.each(events, function( index, value ) {
                //     console.log(index, value.id);
                // });
                // console.log(events[1].id);                
                callback(events);
                    				
				}
			});
		},
		});
	}

    /**
	 * Função - Executar de forma dinâmica via ajax o formulário com base nos dados passado
	 * Nesse caso irá executar os formulário de cadastro e login 
	 * @param {*formulário } form 
	 * @param {*página na qual será enviado o formulário} acao
	 * @param {* método usado (post, get)} metodo
	 * @return - Sucesso / Erro
	 */	
	function scheduler(form, acao, metodo, tipo){
		idForm = form.attr("id");
		
		$.ajax({
			method: metodo,
			url: acao,
			dataType:'json',
			data: form.serialize(),
			success: function(dados){
				if(dados.status == "0"){
					$("#"+idForm +" .box-error").fadeIn();
					$("#"+idForm +" .box-error .erros").html(dados.mensagem);
				}else{					
                    $("#"+idForm +" .box-error").fadeOut();
                    window.location.reload();
				}
			}
		});
	}

    $('#agendarconsulta').on('click', function(ev){
        ev.preventDefault();
        //informações do formulário
        $form = $(this).parent();
		$action = $form.attr('action');
		$method = $form.attr('method');
        // idForm = $form.attr('id');

        //dados do formulário
        // $paciente = $('#paciente').val();
        // $medico = $('#select-medico').val();
        // $dataconsulta = $('#datareal').val();
        console.log($method);
        scheduler($form, $action, $method);
        
    });

    window.desmarcarConsulta = function(id){
        var x = confirm("Tem certeza que deseja desmarcar a consulta #"+id);
        if (x){
            //enviar via ajax ser deletado
            $.ajax({
				url: '../agendamentos/agenda.php',
                method: 'POST',
                dataType: 'json',               
				data: {
                    tipoform: 'deletar',
                    idagenda: id					
				},
                success: function(dados){
                    console.log(dados);
                    if(dados.status =="0"){
                        alert(dados.mensagem);
                    }else{
                        alert(dados.mensagem);                        
                        window.location.reload();
                    }
                }
            });
        }
        else
            return false;
        }

	load_calendar();
});