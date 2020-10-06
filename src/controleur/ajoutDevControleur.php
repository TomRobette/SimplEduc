<?php
    function ajoutDevControleur($twig,$db){
      $form = array();   
      if (isset($_POST['btAjout'])){
        $inputNom = $_POST['inputNom'];
        $inputPrenom = $_POST['inputPrenom'];       
        $inputDate_embauche = $_POST['inputDate_embauche'];   
        $inputCout_horaire = $_POST['inputCout_horaire'];
        $inputAdr_ville = $_POST['inputAdr_ville'];
        $inputAdr_cp = $_POST['inputAdr_cp'];
        $inputAdr_rue = $_POST['inputAdr_rue'];
        $inputAdr_no = $_POST['inputAdr_no'];
        $form['valide'] = true;    
        //die(var_dump($inputNom, $inputPrenom, $inputDate_embauche, $inputCout_horaire, $inputAdr_ville, $inputAdr_cp, $inputAdr_rue, $inputAdr_no));  

        $dev=new Developpeur($db);
        $exec=$dev->insert($inputNom, $inputPrenom, $inputDate_embauche, $inputCout_horaire, $inputAdr_ville, $inputAdr_cp, $inputAdr_rue, $inputAdr_no);
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