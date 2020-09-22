<?php
	class Projet{
        private $db;
		private $insert;
		private $getProjets;

        public function __construct($db){
            $this->db=$db;
            $this->insert = $this->db->prepare("INSERT INTO projet(id_proj, libelle, id_resp)values(:id_proj,:libelle,:id_resp");
			$this->getProjets = $this->db->prepare("SELECT P.id_proj, P.libelle, P.id_resp FROM projet P ORDER BY P.id_proj");
		}

		public function insert($id_proj,$libelle,$id_resp){
			$r = true;
			$this->insert->execute(array(':id_proj'=>$id_proj,':libelle'=>$libelle,':id_resp'=>$id_resp));
			
			if($this->insert->errorCode()!=0){
				print_r($this->insert->errorInfo());
				$r=false;
			}
			return $r;
        }

		public function getProjets(){
			$this->getProjets->execute();
			if ($this->getProjets->errorCode()!=0){
				print_r($this->getProjets->errorInfo());
			}
			return $this->getProjets->fetchAll();
		}
    }
?>   