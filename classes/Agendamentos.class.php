<?php
class Agendamentos{
    protected $table = 'agendamentos'; //definindo a tabela
    private $id;
    private $paciente;
    private $medico;
    private $dataconsulta;
    private $status;

    public function setId($id){
        $this->id = $id;
    }
    public function setPaciente($paciente){            
        $this->paciente = $paciente;
    }
    public function setMedico($medico){
        $this->medico = $medico;
    }		
    public function setDataconsulta($dataconsulta){
        $this->dataconsulta = $dataconsulta;
    }	
    public function setStatus($status){
        $this->status = $status;
    }	
    
    //GET'S
    public function getID(){
        return $this->id;
    }
    public function getPaciente(){
        return $this->paciente;
    }
    public function getMedico(){
        return $this->medico;
    }
    public function getStatus(){
        return $this->status;
    }
    public function getDataconsulta(){
        return $this->dataconsulta;
    }
        
    /**
     * Adicionar agendamento no banco de dados
     */
    public function insert(){

        $sql  = "INSERT INTO $this->table(paciente, medico, dataconsulta, status) VALUES 
        (:paciente, :medico, :dataconsulta, :status)";
        $stmt = @BD::conn()->prepare($sql);
        $stmt->bindParam(':paciente',$this->paciente);
        $stmt->bindParam(':medico',$this->medico);
        $stmt->bindParam(':dataconsulta',$this->dataconsulta);		
        $stmt->bindParam(':status',$this->status);		
            
        if(!$stmt->execute()){
            return false;
        }
        return true;
    }

    public function update(){
		$sql = "UPDATE $this->table SET paciente = :paciente, medico = :medico, dataconsulta = :dataconsulta, status = :status WHERE id = :id";
		
		$stmt = @BD::conn()->prepare($sql);
		$stmt->bindParam(':paciente',$this->paciente);
		$stmt->bindParam(':medico',$this->medico);
		$stmt->bindParam(':dataconsulta',$this->dataconsulta);
		$stmt->bindParam(':status',$this->status);
		$stmt->bindParam(':id', $this->id);

		return $stmt->execute();
	}

    //exibir registro individual
    public function getAgendamentos($queries = array()){		
        $idagenda = (array_key_exists("idagenda", $queries)) ? (int)$queries['idagenda'] : ''; 
        $paciente = (array_key_exists("paciente", $queries)) ? (int)$queries['paciente'] : '';		
        $medico = (array_key_exists("medico", $queries)) ? $queries['medico'] : '';		
        $dataconsulta = (array_key_exists("dataconsulta", $queries)) ? $queries['dataconsulta'] : '';		
        $_where = array();

        if($idagenda) array_push($_where, " a.id = :idagenda ");
        if($paciente) array_push($_where, " paciente = :paciente ");
        if($medico) array_push($_where, " medico = :medico ");
        if($dataconsulta) array_push($_where, " dataconsulta = :dataconsulta ");		

        $w = '';
        if(count($_where) > 0){
            foreach($_where as $key=>$v){
                $w .= ' AND '.$v;
            }
        }
        
        $where = " WHERE status = 'Ativo'  ";
        
        $sql  = "SELECT a.id as idagenda, a.medico, a.paciente, a.dataconsulta, a.status, u.id as userID, u.nome, u.tipousuario, m.id as medicoID, m.medico, m.crm FROM agendamentos AS a INNER JOIN users AS u ON a.paciente = u.id INNER JOIN medicos AS m ON a.medico = m.id $where $w ORDER BY a.id DESC";
                
        $stmt = @BD::conn()->prepare($sql);
        if($idagenda) $stmt->bindParam(':idagenda', $idagenda);
        if($paciente) $stmt->bindParam(':paciente', $paciente);
        if($medico) $stmt->bindParam(':medico', $medico);
        if($dataconsulta) $stmt->bindParam(':dataconsulta', $dataconsulta);
        
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function delete(){			
        $sql  = "DELETE FROM $this->table WHERE id = :id";
        $stmt = @BD::conn()->prepare($sql);
        $stmt->bindParam(':id',$this->id);
        return $stmt->execute();
    }

}
?>