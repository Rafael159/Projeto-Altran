<?php
    class Medicos{
        protected $table = 'medicos'; //definindo a tabela
        private $id;
        private $medico;
        private $crm;
        
        public function setIdUser($id){
            $this->id = $id;
        }
        public function setMedico($medico){            
            $this->medico = $medico;
        }
        public function setCRM($crm){
            $this->crm = $crm;
        }
       
        //GET'S
        public function getID(){
            return $this->id;
        }
        public function getMedico(){
            return $this->medico;
        }
        public function getCRM(){
            return $this->crm;
        }
        
           
        /**
         * Adicionar agendamento no banco de dados
         */
        public function insert(){
    
            $sql  = "INSERT INTO $this->table(medico, crm) VALUES 
            (:medico, :crm)";
            $stmt = @BD::conn()->prepare($sql);
            $stmt->bindParam(':medico',$this->medico);
            $stmt->bindParam(':crm',$this->crm);
            
            if(!$stmt->execute()){
                return false;
            }
            return true;
        }

        //exibir registro individual
	public function getAgendamentos($queries = array()){		
		$id = (array_key_exists("id", $queries)) ? (int)$queries['id'] : ''; 		
		$medico = (array_key_exists("medico", $queries)) ? $queries['medico'] : '';		
		$crm = (array_key_exists("crm", $queries)) ? $queries['crm'] : '';		
		$_where = array();

		if($id) array_push($_where, " id = :id ");		
		if($medico) array_push($_where, " medico = :medico ");
		if($crm) array_push($_where, " crm = :crm ");		

		$w = '';
		if(count($_where) > 0){
			foreach($_where as $key=>$v){
				$w .= ' AND '.$v;
			}
		}
		
		$where = " WHERE id is not null ";
		
		$sql  = "SELECT * FROM medicos AS m $where $w";
                
		$stmt = @BD::conn()->prepare($sql);
		if($id) $stmt->bindParam(':id', (int)$id);
		if($medico) $stmt->bindParam(':medico', $medico);
		if($crm) $stmt->bindParam(':crm', $crm);
		
		$stmt->execute();
		return $stmt->fetchAll();
	}

    }
?>