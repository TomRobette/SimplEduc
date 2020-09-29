<?php
	class Tache{
        private $db;
		private $insert;
        private $getTaches;
		private $delete;
		private $selectLimit;
		private $selectCount;

        public function __construct($db){
            $this->db=$db;
            $this->insert = $this->db->prepare("INSERT INTO Tâche(libelle, temps_tache, status, id_proj)VALUES(:libelle,:temps_tache,:status,:id_proj");
			$this->getTaches = $this->db->prepare("SELECT T.id_tache, T.libelle, T.temps_tache, T.status, T.id_proj, P.libelle FROM Tâche T, Projet P WHERE T.id_proj=P.id_proj ORDER BY T.id_tache");
            $this->delete = $this->db->prepare("DELETE FROM Tâche WHERE id_tache=:id");
			$this->selectLimit = $this->db->prepare("SELECT T.id_tache, T.libelle, T.temps_tache, T.status, T.id_proj, P.libelle FROM Tâche T, Projet P WHERE T.id_proj=P.id_proj ORDER BY T.id_tache LIMIT :inf,:limite");
			$this->selectCount =$this->db->prepare("SELECT COUNT(*) AS nb FROM Tâche");
		}

		public function selectLimit($inf, $limite){
			$this->selectLimit->bindParam(':inf', $inf, PDO::PARAM_INT);
			$this->selectLimit->bindParam(':limite', $limite, PDO::PARAM_INT);
			$this->selectLimit->execute();
			if ($this->selectLimit->errorCode()!=0){
				print_r($this->selectLimit->errorInfo());
			}
			return $this->selectLimit->fetchAll();
		}

		public function selectCount(){
			$this->selectCount->execute();
			if ($this->selectCount->errorCode()!=0){
				print_r($this->selectCount->errorInfo());
			}
			return $this->selectCount->fetch();
		}

		public function delete($id){
			$r = true;
			$this->delete->execute(array(':id'=>$id));
			if ($this->delete->errorCode()!=0){
				print_r($this->delete->errorInfo());
				$r=false;
			}
			return $r;
		}

		public function insert($libelle, $temps_tache, $status, $id_proj){
			$r = true;
			$this->insert->execute(array(':libelle'=>$libelle,':temps_tache'=>$temps_tache,':status'=>$status, ':id_proj'=>$id_proj));
			
			if($this->insert->errorCode()!=0){
				print_r($this->insert->errorInfo());
				$r=false;
			}
			return $r;
		}

		public function getProjets(){
			$this->getProjetsFromClient->execute();
			if ($this->getProjetsFromClient->errorCode()!=0){
				print_r($this->getProjetsFromClient->errorInfo());
			}
			return $this->getProjetsFromClient->fetchAll();
		}
    }
?>   