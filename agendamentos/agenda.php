<?php 
	date_default_timezone_set('America/Sao_Paulo');

    spl_autoload_register(function($classe) {
        require('../classes/'.$classe.'.class.php');
    });
    
    $agenda = new Agendamentos;
    $notificacao = new Notificacoes;

    $idpaciente = (isset($_POST['idpaciente'])) ? trim($_POST['idpaciente']) : '1';
    $medico = (isset($_POST['medico'])) ? ((int)$_POST['medico']) : '';
    $dataconsulta = (isset($_POST['datareal'])) ? trim($_POST['datareal']) : '';
    $tipo = (isset($_POST['tipoform'])) ? trim($_POST['tipoform']) : 'consultaindividual';

    $user = Usuarios::getUsuario();
    $tipouser = $user->tipousuario;

    switch($tipo){
        case 'inserir':
            //validação
            if(empty($idpaciente)):
                $retorno = array('status'=>'0', 'mensagem'=>'Paciente não informado');
                echo json_encode($retorno);
                exit();
            endif;

            if(empty($medico)):
                $retorno = array('status'=>'0', 'mensagem'=>'Favor informar o médico');
                echo json_encode($retorno);
                exit();
            endif;
            if(empty($dataconsulta)):
                $retorno = array('status'=>'0', 'mensagem'=>'Favor informar a data da consulta');
                echo json_encode($retorno);
                exit();
            endif;

            //cadastrar agendamento
            $agenda->setPaciente($idpaciente);
            $agenda->setMedico($medico);
            $agenda->setDataconsulta($dataconsulta);
            $agenda->setStatus('Ativo');
            if($agenda->insert()){
                //adicionar notificação
                $notificacao->setTipo('Consulta adicionada');
                $notificacao->setMensagem('Uma nova consulta foi adicionada');
                $notificacao->setUsuario($user->id);
                $notificacao->setDataacao(date('Y-m-d H:i:s'));

                $notificacao->insertNotificacao();

                $retorno = array('status'=>'1', 'mensagem'=>'Parabéns');
                echo json_encode($retorno);
                exit();
            }  
            
        break;
        case 'consultaindividual':
            $agenda_pessoal = $agenda->getAgendamentos(array('paciente'=>$user->id));
            
            $events = [];
                
            foreach($agenda_pessoal as $k=>$aux):
                
                $start = explode(' ',$aux->dataconsulta); 
                $event = [];

                $event['title'] = $aux->nome;
                $event['start'] = $start[0] . 'T' . $start[1];                    
                $event['paciente'] = $aux->nome;                    
                
                if($start[1] == '00:00:00'){ 
                    $event['allDay'] = true;
                }else{
                    $event['allDay'] = false;
                }

                $event['color'] = '#069';

                array_push($events, $event);

            endforeach;            
            echo json_encode($events);
        break;
        case 'consultas':
            $agenda_pessoal = $agenda->getAgendamentos();
            
            $events = [];
                
            foreach($agenda_pessoal as $k=>$aux):
                
                $start = explode(' ',$aux->dataconsulta); 
                $event = [];
               
                $event['title'] = $aux->nome;
                $event['start'] = $start[0] . 'T' . $start[1];                    
                $event['paciente'] = $aux->nome;                    
                $event['medico'] = $aux->medicoID;                    
                $event['idpaciente'] = $aux->paciente;
                $event['idagenda'] = $aux->idagenda;
                
                if($start[1] == '00:00:00'){ 
                    $event['allDay'] = true;
                }else{
                    $event['allDay'] = false;
                }

                array_push($events, $event);

            endforeach; 
          
            echo json_encode($events);
        break;
        case 'deletar':
        
            $idagenda = (isset($_POST['idagenda'])) ? (int)$_POST['idagenda'] : '';
            if(empty($idagenda)){

                $retorno = array('status'=>'0', 'mensagem'=>'Nenhuma consulta indentificada para ser desmarcar');
                echo json_encode($retorno);
                exit();
           
            }
            $agenda->setId($idagenda);
            if($agenda->delete()){

                $notificacao->setTipo('Consulta deletada');
                $notificacao->setMensagem('A consulta #'.$idagenda.' foi excluída pelo paciente');
                $notificacao->setUsuario($user->id);
                $notificacao->setDataacao(date('Y-m-d H:i:s'));

                $notificacao->insertNotificacao();

                $retorno = array('status'=>'1', 'mensagem'=>'Consulta desmarcada com sucesso!');
                echo json_encode($retorno);
                exit();
            }else{
                $retorno = array('status'=>'0', 'mensagem'=>'Desculpe-nos! Houve um erro ao desmarcar a consulta');
                echo json_encode($retorno);
                exit();
            }
            
        break;
        case 'atualizar':
            $idagenda = (isset($_POST['up-idagenda'])) ? ((int)$_POST['up-idagenda']) : '';
            $medico = (isset($_POST['medico'])) ? ((int)$_POST['medico']) : '';
            $dataconsulta = (isset($_POST['up-datareal'])) ? trim($_POST['up-datareal']) : '';

            if(empty($idagenda)):
                $retorno = array('status'=>'0', 'mensagem'=>'Nenhum consulta informada');
                echo json_encode($retorno);
                exit();
            endif;

            if(empty($idpaciente)):
                $retorno = array('status'=>'0', 'mensagem'=>'Paciente não informado');
                echo json_encode($retorno);
                exit();
            endif;

            if(empty($medico)):
                $retorno = array('status'=>'0', 'mensagem'=>'Favor informar o médico');
                echo json_encode($retorno);
                exit();
            endif;
            if(empty($dataconsulta)):
                $retorno = array('status'=>'0', 'mensagem'=>'Favor informar a data da consulta');
                echo json_encode($retorno);
                exit();
            endif;

            //cadastrar agendamento
            $agenda->setId($idagenda);
            $agenda->setPaciente($idpaciente);
            $agenda->setMedico($medico);
            $agenda->setDataconsulta($dataconsulta);
            $agenda->setStatus('Ativo');

            if($agenda->update()){
                if($tipouser == 1){
                    $notificacao->setTipo('Consulta atualizada');
                    $notificacao->setMensagem('A consulta #'.$idagenda.' foi atualizada pelo paciente');
                    $notificacao->setUsuario($user->id);
                    $notificacao->setDataacao(date('Y-m-d H:i:s'));

                    $notificacao->insertNotificacao();
                }

                $retorno = array('status'=>'1', 'mensagem'=>'Consulta atualizada com sucesso');
                echo json_encode($retorno);
                exit();
            }else{
                $retorno = array('status'=>'0', 'mensagem'=>'Desculpe! Houve um erro ao atualizar a consulta');
                echo json_encode($retorno);
                exit();
            }
        break;
        case 'getEvento':
            $idagenda = (isset($_POST['idagenda'])) ? ((int)$_POST['idagenda']) : '';
            
            $evento = $agenda->getAgendamentos(array('idagenda'=>$idagenda));
           
            echo json_encode($evento);
            exit();
        break;

        case 'deletaEventoAdm':
            $idagenda = (isset($_POST['idagenda'])) ? (int)$_POST['idagenda'] : '';
            if(empty($idagenda)){
                $retorno = array('status'=>'0', 'mensagem'=>'Nenhuma consulta indentificada para ser desmarcar');
                echo json_encode($retorno);
                exit();        
            }
            $agenda->setId($idagenda);
            if($agenda->delete()){
                $retorno = array('status'=>'1', 'mensagem'=>'Consulta desmarcada com sucesso!');
                echo json_encode($retorno);
                exit();
            }else{
                $retorno = array('status'=>'0', 'mensagem'=>'Desculpe-nos! Houve um erro ao desmarcar a consulta');
                echo json_encode($retorno);
                exit();
            }
        break;
        default:
        break;
    }
?>