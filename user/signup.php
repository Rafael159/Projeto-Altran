<?php 
//echo dirname((__FILE__));
spl_autoload_register(function($classe) {
	require('../classes/'.$classe.'.class.php');	
});
$user = new Usuarios();

//validação e cadastro do usuário	
$nome = (isset($_POST['nome'])) ? trim($_POST['nome']) : '';
$email = (isset($_POST['email'])) ? trim($_POST['email']) : '';
$senha = (isset($_POST['senha'])) ? trim($_POST['senha']) : '';
$cidade = (isset($_POST['cidade'])) ? trim($_POST['cidade']) : '';
$telefone = (isset($_POST['telefone'])) ? trim($_POST['telefone']) : '';
$sexo = (isset($_POST['sexo'])) ? trim($_POST['sexo']) : '';
$tipo = (isset($_POST['tipousuario'])) ? $_POST['tipousuario'] : 0;

$retorno = array();

if (empty($nome)) :
	$retorno = array('status' => '0', 'mensagem' => 'Campo recomendado! Insira seu nome');
	echo json_encode($retorno);
	exit();
endif;

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) :
	$retorno = array('status' => '0', 'mensagem' => 'Email incorreto! Insira um email válido');
	echo json_encode($retorno);
	exit();
endif;

$_row = $user->findEmail(array('email' => $email));
$qtd = count($_row);

if ($qtd >= 1) :
	$retorno = array('status' => '0', 'mensagem' => 'Email já existe, por favor insira outro');
	echo json_encode($retorno);
	exit();
endif;

if (empty($senha) or strlen($senha) < 6) :
	$retorno = array('status' => '0', 'mensagem' => 'Senha deve ter no mínimo 6 caracteres');
	echo json_encode($retorno);
	exit();
endif;

if (empty($tipo)) :
	$retorno = array('status' => '0', 'mensagem' => 'Selecione o tipo de usuário');
	echo json_encode($retorno);
	exit();
endif;

if (empty($sexo)) :
	$retorno = array('status' => '0', 'mensagem' => 'Informe o sexo do usuário');
	echo json_encode($retorno);
	exit();
endif;

//criptografia da senha com BCRYPT
$custo = '08'; //ajuda no formação da senha única*/
$salto = 'Cf1f11ePArKlBJomM0F6aJ'; //garante que a senha não se repita
$senha = crypt($senha, '$2a$' . $custo . '$' . $salto . '$');

date_default_timezone_set('America/Sao_Paulo');
$logfirst = date('Y-m-d H:i:s');

//Setar valores na classe			
$user->setNome($nome);
$user->setEmail($email);
$user->setSenha($senha);
$user->setTelefone($telefone);
$user->setCidade($cidade);
$user->setTipousuario((int)$tipo);
$user->setSexo($sexo);
$user->setFirstLog(date('Y-m-d H:i'));
$user->setLogUsuario(null);
$sql = $user->insert();

//Se não cadastrar, mande uma mensagem de erro
if (!$sql) :
	$retorno = array('status' => '0', 'mensagem' => 'Ocorreu algum erro! Tente novamente mais tarde');
	echo json_encode($retorno);
	exit();
else :
	$retorno = array('status' => '1', 'mensagem' => '');
	echo json_encode($retorno);
	exit();	
endif;

?>