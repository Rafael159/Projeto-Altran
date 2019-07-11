<?php
class Notificacoes{
    protected $table = 'notificacoes';

    private $id;
    private $tipo;
    private $mensagem;
    private $usuario;
    private $dataacao;

    public function setID($id){
        $this->id = $id;
    }    
    public function setTipo($tipo){
        $this->tipo = $tipo;
    }
    public function setMensagem($mensagem){
        $this->mensagem = $mensagem;
    }
    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    public function setDataacao($dataacao){
        $this->dataacao = $dataacao;
    }
    
    public function getID(){
        return $this->id;
    }    
    public function getTipo(){
        return $this->tipo;
    }
    public function getMensagem(){
        return $this->mensagem;
    }
    public function getUsuario(){
        return $this->usuario;
    }
    public function getDataacao(){
        return $this->dataacao;
    }
    
    public function insertNotificacao(){

		$sql = "INSERT INTO $this->table (tipo, mensagem, usuario, dataacao) 
                VALUES(:tipo, :mensagem, :usuario, :dataacao)";
        //preparar SQL
        $stmt = @BD::conn()->prepare($sql);
        //setar valores        
		$stmt->bindParam(':tipo', $this->tipo);
        $stmt->bindParam(':mensagem', $this->mensagem);
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->bindParam(':dataacao', $this->dataacao);

		return $stmt->execute();
    }
    
    public function updateNotificacao(){
        $sql = "UPDATE $this->table SET (titulo = :titulo, tipo = :tipo, mensagem = :mensagem, receptor = :receptor, lido = :lido, dataalerta = :dataalerta) WHERE id = :id";
        //preparar SQL        
        $stmt = @BD::conn()->prepare($sql);
        //setar valores
        $stmt->bindParam(':id', $this->id);
		$stmt->bindParam(':titulo', $this->titulo);
		$stmt->bindParam(':tipo', $this->tipo);
		$stmt->bindParam(':mensagem', $this->mensagem);
		$stmt->bindParam(':receptor', $this->receptor);
		$stmt->bindParam(':lido', $this->lido);
		$stmt->bindParam(':dataalerta', $this->dataalerta);
        
        return $stmt->execute();
    }
    
    public function getNotificacoes(){
		
		$sql  = "SELECT n.id as idnotifica, n.tipo, n.mensagem, n.usuario, n.dataacao, u.id as iduser, u.nome FROM notificacoes n INNER JOIN users AS u ON n.usuario = u.id ORDER BY n.id DESC";
		
		$stmt = @BD::conn()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
    }

    public static function contarNotificacoes($queries = array()){        
        $rows = new Notificacoes;
        $row = $rows->getNotificacoes($queries);
       
        return count($row);
    }
}

?>