<?php
    function ajoutDevControleur($twig,$db){


      $form = array();     
      if (isset($_POST['btAjout'])){
        $inputNom= $_POST['inputNom'];
        $inputPrenom= $_POST['inputPrenom'];       
        $inputDate_embauche=$_POST['inputDate_embauche'];   
        $inputCoût_horaire = $_POST['inputCoût_horaire'];
        $inputAdr_ville = $_POST['inputAdr_ville'];
        $inputAdr_cp = $_POST['inputAdr_cp'];
        $inputAdr_rue = $_POST['inputAdr_rue'];
        $inputAdr_no = $_POST['inputAdr_no'];
        $form['valide'] = true;      

        $dev=new Developpeur($db);
        $exec=$dev->insert($nom, $prenom, $date_embauche, $coût_horaire, $adr_ville, $adr_cp, $adr_rue, $adr_no);
          if(!$exec){
            $form['valide'] = false;
            $form['message'] = 'Problème d\'insertion dans la table développeur ';
          }else{ 
            header("Location:index.php");    
          }
      }
        echo $twig -> render('ajoutDev.html.twig',array());
    }
?>