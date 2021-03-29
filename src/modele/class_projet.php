<?php
	class Projet{
        private $db;
		private $insert;
        private $getProjets;
        private $getProjetsFromClient;
		private $delete;
		private $selectLimit;
		private $selectCount;
		private $getProjetById;
		private $getDevs;

        public function __construct($db){
            $this->db=$db;
            $this->insert = $this->db->prepare("INSERT INTO Projet(libelle, id_resp, id_contrat)values(:libelle,:id_resp,:id_contrat");
			$this->getProjets = $this->db->prepare("SELECT P.id_proj, P.libelle, P.id_resp, D.nom, D.prenom FROM Projet P, Developpeur D WHERE P.id_resp=D.id_dev ORDER BY P.id_proj");
            $this->getProjetsFromClient = $this->db->prepare("SELECT P.id_proj, P.libelle, P.id_resp, C.date_signature FROM Projet P, Contrat C WHERE P.id_contrat=C.id_contrat AND C.id_entreprise=:id_entreprise ORDER BY P.id_proj");
			$this->delete = $this->db->prepare("DELETE FROM Projet WHERE id_proj=:id");
			$this->selectLimit = $this->db->prepare("SELECT P.id_proj, P.libelle, P.id_resp, D.nom, D.prenom FROM Projet P, Developpeur D WHERE P.id_resp=D.id_dev ORDER BY P.id_proj LIMIT :inf,:limite");
			$this->selectCount =$this->db->prepare("SELECT COUNT(*) AS nb FROM Projet");
			$this->getProjetById = $this->db->prepare("SELECT P.id_proj, P.libelle AS libelleProj, P.id_resp, D.nom, D.prenom, SUM(T.temps_tache) AS totalTemps, SUM(T.cout) AS totalCout FROM Projet P, Developpeur D, Tâche T WHERE P.id_resp=D.id_dev AND T.id_proj=P.id_proj AND P.id_proj=:id");
			$this->getDevs = $this->db->prepare("SELECT T.id_tache, T.libelle, D.nom, D.prenom, A.datedebut, A.datefin FROM Projet P, Developpeur D, Tâche T, Affecter A WHERE T.id_tache=A.id_tache AND A.id_dev=D.id_dev AND T.id_proj=P.id_proj AND P.id_proj=:id GROUP BY D.nom ORDER BY T.id_tache");
		}

		public function getDevs($id){
			$this->getDevs->execute(array(':id'=>$id));
			if ($this->getDevs->errorCode()!=0){
				print_r($this->getDevs->errorInfo());
			}
			return $this->getDevs->fetchAll();
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

		public function insert($libelle,$id_resp,$id_contrat){
			$r = true;
			$this->insert->execute(array(':libelle'=>$libelle,':id_resp'=>$id_resp,':id_contrat'=>$id_contrat));
			
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

		public function getProjetById($id){
			$this->getProjetById->execute(array(':id'=>$id));
			if ($this->getProjetById->errorCode()!=0){
				print_r($this->getProjetById->errorInfo());
			}
			return $this->getProjetById->fetch();
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