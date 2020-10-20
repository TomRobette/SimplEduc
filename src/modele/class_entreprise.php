<?php
	class Entreprise{
        private $db;
		private $insert;
        private $getEntreprises;
		private $delete;
		private $selectLimit;
		private $selectCount;
		private $getProjetsFromThis;
		private $selectLimitProj;
		private $selectCountProj;
		private $getEntrepriseById;

        public function __construct($db){
            $this->db=$db;
            $this->insert = $this->db->prepare("INSERT INTO Entreprise(libelle, adr_ville, adr_cp, adr_rue, adr_no, nom_contact, prenom_contact, tel_contact)VALUES(:libelle, :adr_ville, :adr_cp, :adr_rue, :adr_no, :nom_contact, :prenom_contact, :tel_contact)");
			$this->getEntreprises = $this->db->prepare("SELECT id_entreprise, libelle, adr_ville, adr_cp, adr_rue, adr_no, nom_contact, prenom_contact, tel_contact FROM Entreprise ORDER BY id_entreprise");
			$this->delete = $this->db->prepare("DELETE FROM Entreprise WHERE id_entreprise=:id");
			$this->selectLimit = $this->db->prepare("SELECT id_entreprise, libelle, adr_ville, adr_cp, adr_rue, adr_no, nom_contact, prenom_contact, tel_contact FROM Entreprise ORDER BY id_entreprise LIMIT :inf,:limite");
			$this->selectCount =$this->db->prepare("SELECT COUNT(*) AS nb FROM Entreprise");
			$this->getProjetsFromThis = $this->db->prepare("SELECT P.libelle AS projetlib, C.date_signature AS sign FROM Entreprise E, Projet P, Contrat C WHERE E.id_entreprise=C.id_entreprise AND C.id_contrat=P.id_contrat AND E.id_entreprise=:id");
			$this->selectLimitProj = $this->db->prepare("SELECT P.libelle AS projetlib, C.date_signature AS sign FROM Entreprise E, Projet P, Contrat C WHERE E.id_entreprise=C.id_entreprise AND C.id_contrat=P.id_contrat AND E.id_entreprise=:id ORDER BY sign LIMIT :inf,:limite");
			$this->selectCountProj =$this->db->prepare("SELECT COUNT(*) AS nb FROM Entreprise E, Projet P, Contrat C WHERE E.id_entreprise=C.id_entreprise AND C.id_contrat=P.id_contrat AND E.id_entreprise=:id");
			$this->getEntrepriseById = $this->db->prepare("SELECT id_entreprise, libelle, adr_ville, adr_cp, adr_rue, adr_no, nom_contact, prenom_contact, tel_contact FROM Entreprise WHERE id_entreprise=:id");
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

		public function selectLimitProj($inf, $limite, $id){
			$this->selectLimitProj->bindParam(':inf', $inf, PDO::PARAM_INT);
			$this->selectLimitProj->bindParam(':limite', $limite, PDO::PARAM_INT);
			$this->selectLimitProj->bindParam(':id', $limidite, PDO::PARAM_INT);
			$this->selectLimitProj->execute();
			if ($this->selectLimitProj->errorCode()!=0){
				print_r($this->selectLimitProj->errorInfo());
			}
			return $this->selectLimitProj->fetchAll();
		}

		public function selectCountProj($id){
			$this->selectCountProj->execute(array(':id'=>$id));
			if ($this->selectCountProj->errorCode()!=0){
				print_r($this->selectCountProj->errorInfo());
			}
			return $this->selectCountProj->fetch();
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

		public function insert($libelle, $adr_ville, $adr_cp, $adr_rue, $adr_no, $nom_contact, $prenom_contact, $tel_contact){
			$r = true;
			$this->insert->execute(array(':libelle'=>$libelle, ':adr_ville'=>adr_ville, ':adr_cp'=>adr_cp, ':adr_rue'=>adr_rue, ':adr_no'=>adr_no, ':nom_contact'=>nom_contact, ':prenom_contact'=>prenom_contact, ':tel_contact'=>tel_contact));
			
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

		public function getProjetsFromThis($id){
			$this->getProjetsFromThis->execute(array(':id'=>$id));
			if ($this->getProjetsFromThis->errorCode()!=0){
				print_r($this->getProjetsFromThis->errorInfo());
			}
			return $this->getProjetsFromThis->fetchAll();
		}

		public function getEntrepriseById($id){
			$this->getEntrepriseById->execute(array(':id'=>$id));
			if ($this->getEntrepriseById->errorCode()!=0){
				print_r($this->getEntrepriseById->errorInfo());
			}
			return $this->getEntrepriseById->fetch();
		}
    }
?>   