$(document).ready(function(){
	//funções gerais do sistema

	/**
	 * @param {*id do formulário} idForm 
	 */
	function limparFormulário(idForm){
		$('#'+idForm).each (function(){
			this.reset();
		});
	}
	/**
	 * @param {*Mensagem que será exibida no box} mensagem 
	 */
	function alerta(mensagem){
		$("#caixa-mensagem").html(mensagem);
		$("#caixaAlerta").modal();
	}

	/**
	 * Função - Executar de forma dinâmica via ajax o formulário com base nos dados passado
	 * Nesse caso irá executar os formulário de cadastro e login 
	 * @param {*formulário } form 
	 * @param {*página na qual será enviado o formulário} acao
	 * @param {* método usado (post, get)} metodo
	 * @return - Sucesso / Erro
	 */	
	function executaFormulario(form, acao, metodo, tipo){
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
					if(tipo == "cadastro"){
						$("#"+idForm +" .box-error").fadeOut();
						alerta('Parabéns. Seu cadastro foi realizado com sucesso. <br/>Agora é só fazer login para acessar o sistema');
						limparFormulário(idForm);
					}else{
						$("#"+idForm +" .box-error").fadeOut();
						if(dados.nivel=="1"){
							window.location.href="../cliente/dashboard.php";
						}else{
							window.location.href="../admin/dashboard.php"
						}
					}					
				}
			}	
		});
	}

	/**Máscaras**/
	$("#cadtelefone").mask("(99) 99999-9999");

	/**
	 * Funções referente ao cadastro do cliente
	*/
	$('#btn-signup').on('click', function(ev){
		ev.preventDefault();//impedir o formulário de se submeter automaticamente
		//pegar informações do formulário - independente qual seja
		$form = $(this).parent();
		$action = $form.attr('action');
		$method = $form.attr('method');		

		executaFormulario($form, $action, $method);
	});
	 /**
	 * Fim das Funções referente ao cadastro do cliente
	 */

	 /**
	 * Funções referente ao Login
	 */
	$('#btn-signin').on('click', function(ev){
		ev.preventDefault();//impedir o formulário de se submeter automaticamente
		$form = $(this).parent();
		$action = $form.attr('action');
		$method = $form.attr('method');		

		executaFormulario($form, $action, $method);
	});
	/*Fim funções referente ao login */

});