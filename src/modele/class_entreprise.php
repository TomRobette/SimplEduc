<?php
	class Entreprise{
        private $db;
		private $insert;
        private $getEntreprises;
		private $delete;
		private $selectLimit;
		private $selectCount;
		private $getProjetsFromThis;

        public function __construct($db){
            $this->db=$db;
            $this->insert = $this->db->prepare("INSERT INTO Entreprise(adr_ville, adr_cp, adr_rue, adr_no, nom_contact, prenom_contact, tel_contact)VALUES(:adr_ville, :adr_cp, :adr_rue, :adr_no, :nom_contact, :prenom_contact, :tel_contact)");
			$this->getEntreprises = $this->db->prepare("SELECT id_entreprise, adr_ville, adr_cp, adr_rue, adr_no, nom_contact, prenom_contact, tel_contact FROM Entreprise ORDER BY id_entreprise");
			$this->delete = $this->db->prepare("DELETE FROM Entreprise WHERE id_entreprise=:id");
			$this->selectLimit = $this->db->prepare("SELECT id_entreprise, adr_ville, adr_cp, adr_rue, adr_no, nom_contact, prenom_contact, tel_contact FROM Entreprise ORDER BY id_entreprise LIMIT :inf,:limite");
			$this->selectCount =$this->db->prepare("SELECT COUNT(*) AS nb FROM Entreprise");
			$this->getProjetsFromThis = $this->db->prepare("SELECT P.libelle AS Projet, C.date_signature FROM Entreprise E RIGHT JOIN Contrat C ON E.id_entreprise=C.id_entreprise RIGHT JOIN Projet P ON C.id_contrat=P.id_contrat ORDER BY C.date_sinature");
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

		public function getEntreprises(){
			$this->getEntreprises->execute();
			if ($this->getEntreprises->errorCode()!=0){
				print_r($this->getEntreprises->errorInfo());
			}
			return $this->getEntreprises->fetchAll();
		}

		public function getProjetsFromThis(){
			$this->getProjetsFromThis->execute();
			if ($this->getProjetsFromThis->errorCode()!=0){
				print_r($this->getProjetsFromThis->errorInfo());
			}
			return $this->getProjetsFromThis->fetchAll();
		}
    }
?>   