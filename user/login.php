<?php 
spl_autoload_register(function($classe) {
	require('../classes/'.$classe.'.class.php');	
});
$user = new Usuarios();

/*Get email e senha*/
$email = (isset($_POST['email'])) ? trim($_POST['email']) : 'rafael@gmail.com';
$senha = (isset($_POST['senha'])) ? trim($_POST['senha']) : '12345678';

if(empty($email)):
	$retorno = array('status'=>'0', 'mensagem'=>'Email é campo obrigatório');
	echo json_encode($retorno);
	exit();
endif;

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $retorno = array('status'=>'0', 'mensagem'=>'Por favor informe um e-mail válido');
    echo json_encode($retorno);
    exit();
}

$mail = strip_tags(trim($email));
$row = $user->getRegister(array('email'=>$mail));

if(sizeof($row)==0){
    $retorno = array('status'=>'0', 'mensagem'=>'E-mail informado não encontrado. Informe o e-mail usado no cadastro');
    echo json_encode($retorno);
    exit();
}

if(empty($senha)):
    $retorno = array('status'=>'0', 'mensagem'=>'Senha é campo obrigatório');
    echo json_encode($retorno);
    exit();
endif;

$custo = '08';//ajuda no formação da senha única*/
$salto = 'Cf1f11ePArKlBJomM0F6aJ';//garante que a senha não se repita
$senha = crypt($senha, '$2a$' . $custo . '$' . $salto . '$');//criar senha com suas variáveis estáveis

$user->setEmail($email);//setar email
$user->setSenha($senha);//setar senha

$dados = $user->loginUser();//logar

/*SE RETORNAR O USER*/
if($dados):
    session_start();
    //definir sessões
    unset($dados->senha);
    unset($dados->logusuario);
    unset($dados->logfirst);
    
    $_SESSION['id'] = $dados->id;
    $_SESSION['email'] = $dados->email;
    $_SESSION['nome']  = $dados->nome;				
    $_SESSION['tipousuario']  = $dados->tipousuario;

    $retorno = array('status'=>'1', 'mensagem'=>'Logado com sucesso', 'nivel'=>$dados->tipousuario);
    echo json_encode($retorno);
else:
    $retorno = array('status'=>'0', 'mensagem'=>'Falha ao logar! Verifique seu email e/ou senha');
    echo json_encode($retorno);
    exit();
endif;

?>