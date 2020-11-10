<?php
	class Affecter{
        private $db;
		private $insert;
        private $getAffecter;
		

        public function __construct($db){
            $this->db=$db;
            $this->insert = $this->db->prepare("INSERT INTO Affecter(id_dev, id_tache, temps)values(:id_dev,:id_tache,:temps");
			$this->getAffecter = $this->db->prepare("SELECT a.id_dev, a.id_tache, temps FROM Affecter a, Developpeur d, Tache t WHERE a.id_dev=d.id_dev AND a.id_tache=t.id_tache");
            
		}


		public function insert($id_dev,$id_tache,$temps){
			$r = true;
			$this->insert->execute(array(':id_dev'=>$id_dev,':id_tache'=>$id_tache,':temps'=>$temps));
			
			if($this->insert->errorCode()!=0){
				print_r($this->insert->errorInfo());
				$r=false;
			}
			return $r;
		}


		public function getAffecter(){
			$this->getProjets->execute();
			if ($this->getProjets->errorCode()!=0){
				print_r($this->getProjets->errorInfo());
			}
			return $this->getProjets->fetchAll();
		}
    }
?>   