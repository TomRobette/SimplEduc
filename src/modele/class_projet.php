<?php
	class Projet{
        private $db;
		private $insert;
        private $getProjets;
        private $getProjetsFromClient;
		private $delete;
		private $selectLimit;
		private $selectCount;

        public function __construct($db){
            $this->db=$db;
            $this->insert = $this->db->prepare("INSERT INTO projet(id_proj, libelle, id_resp)values(:id_proj,:libelle,:id_resp");
			$this->getProjets = $this->db->prepare("SELECT P.id_proj, P.libelle, P.id_resp, D.nom, D.prenom FROM projet P, developpeur D WHERE P.id_resp=D.id_dev ORDER BY P.id_proj");
            $this->getProjetsFromClient = $this->db->prepare("SELECT P.id_proj, P.libelle, P.id_resp, C.date_signature FROM projet P, contrat c WHERE P.id_contrat=C.id_contrat AND C.id_entreprise=:id_entreprise ORDER BY P.id_proj");
			$this->delete = $this->db->prepare("DELETE FROM projet WHERE id_proj=:id");
			$this->selectLimit = $this->db->prepare("SELECT P.id_proj, P.libelle, P.id_resp, D.nom, D.prenom FROM projet P, developpeur D WHERE P.id_resp=D.id_dev ORDER BY P.id_proj LIMIT :inf,:limite");
			$this->selectCount =$this->db->prepare("SELECT COUNT(*) AS nb FROM projet");
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

		public function insert($id_proj,$libelle,$id_resp){
			$r = true;
			$this->insert->execute(array(':id_proj'=>$id_proj,':libelle'=>$libelle,':id_resp'=>$id_resp));
			
			if($this->insert->errorCode()!=0){
				print_r($this->insert->errorInfo());
				$r=false;
			}
			return $r;
		}

		public function getProjetsFromClient($id_entreprise){
			$this->getProjetsFromClient->execute(array(':id_entreprise'=>$id_entreprise));
			if ($this->getProjetsFromClient->errorCode()!=0){
				print_r($this->getProjetsFromClient->errorInfo());
			}
			return $this->getProjetsFromClient->fetchAll();
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