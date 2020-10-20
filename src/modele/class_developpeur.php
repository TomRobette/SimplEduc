<?php
	class Developpeur{
        private $db;
		private $insert;
		private $getDeveloppeurs;
		private $getDeveloppeurById;
		private $delete;
		private $selectLimit;
		private $selectCount;
		private $modify;

        public function __construct($db){
            $this->db=$db;
            $this->insert = $this->db->prepare("INSERT INTO Developpeur(nom, prenom, date_embauche, cout_horaire, adr_ville, adr_cp, adr_rue, adr_no) VALUES (:nom, :prenom, :date_embauche, :cout_horaire, :adr_ville, :adr_cp, :adr_rue, :adr_no)");
			$this->getDeveloppeurs = $this->db->prepare("SELECT id_dev, nom, prenom, date_embauche, cout_horaire, adr_ville, adr_cp, adr_rue, adr_no FROM Developpeur ORDER BY date_embauche");
            $this->getDeveloppeurById = $this->db->prepare("SELECT id_dev, nom, prenom, date_embauche, cout_horaire, adr_ville, adr_cp, adr_rue, adr_no FROM Developpeur WHERE id_dev=:id");
            $this->delete = $this->db->prepare("DELETE FROM Developpeur WHERE id_dev=:id");
			$this->selectLimit = $this->db->prepare("SELECT id_dev, nom, prenom, date_embauche, cout_horaire, adr_ville, adr_cp, adr_rue, adr_no FROM Developpeur ORDER BY date_embauche LIMIT :inf,:limite");
			$this->selectCount =$this->db->prepare("SELECT COUNT(*) AS nb FROM Developpeur");
			$this->modify = $this->db->prepare("UPDATE Developpeur SET nom=:nom, prenom=:prenom, date_embauche=:date_embauche, cout_horaire=:cout_horaire, adr_ville=:adr_ville, adr_cp=:adr_cp, adr_rue=:adr_rue, adr_no=:adr_no WHERE id_dev=:id");
		}

		public function modify($id, $nom, $prenom, $date_embauche, $cout_horaire, $adr_ville, $adr_cp, $adr_rue, $adr_no){
			$r = true;
			$this->modify->execute(array(':id'=>$id, ':id'=>$id, ':nom'=>$nom, ':prenom'=>$prenom, ':date_embauche'=>$date_embauche, ':cout_horaire'=>$cout_horaire, ':adr_ville'=>$adr_ville, ':adr_cp'=>$adr_cp, ':adr_rue'=>$adr_rue, ':adr_no'=>$adr_no));
			if ($this->modify->errorCode()!=0){
				print_r($this->modify->errorInfo());
				$r=false;
			}
			return $r;
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

		public function insert($nom, $prenom, $date_embauche, $cout_horaire, $adr_ville, $adr_cp, $adr_rue, $adr_no){
			$r = true;
			$this->insert->execute(array(':nom'=>$nom, ':prenom'=>$prenom, ':date_embauche'=>$date_embauche, ':cout_horaire'=>$cout_horaire, ':adr_ville'=>$adr_ville, ':adr_cp'=>$adr_cp, ':adr_rue'=>$adr_rue, ':adr_no'=>$adr_no));
			
			if($this->insert->errorCode()!=0){
				print_r($this->insert->errorInfo());
				$r=false;
			}
			return $r;
		}

		public function getDeveloppeurs(){
			$this->getDeveloppeurs->execute();
			if ($this->getDeveloppeurs->errorCode()!=0){
				print_r($this->getDeveloppeurs->errorInfo());
			}
			return $this->getDeveloppeurs->fetchAll();
		}

		public function getDeveloppeurById($id){
			$this->getDeveloppeurById->execute(array(':id'=>$id));
			if ($this->getDeveloppeurById->errorCode()!=0){
				print_r($this->getDeveloppeurById->errorInfo());
			}
			return $this->getDeveloppeurById->fetch();
		}
    }
?>   