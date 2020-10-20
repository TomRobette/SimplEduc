<?php
    function modifDevControleur($twig,$db){
      $form = array();   
      if(isset($_GET['id'])){        
        $dev=new Developpeur($db);
        $unDev=$dev->getDeveloppeurById($_GET['id']);
        $form['unDev'] = $unDev;
        if(isset($_POST['btModif'])){
            $inputNom = $_POST['inputNom'];
            $inputPrenom = $_POST['inputPrenom'];       
            $inputDate_embauche = $_POST['inputDate_embauche'];   
            $inputCout_horaire = $_POST['inputCout_horaire'];
            $inputAdr_ville = $_POST['inputAdr_ville'];
            $inputAdr_cp = $_POST['inputAdr_cp'];
            $inputAdr_rue = $_POST['inputAdr_rue'];
            $inputAdr_no = $_POST['inputAdr_no'];
            $form['valide'] = true;    
            $exec=$dev->modif($inputNom, $inputPrenom, $inputDate_embauche, $inputCout_horaire, $inputAdr_ville, $inputAdr_cp, $inputAdr_rue, $inputAdr_no);
            if(!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table développeur ';
            }else{ 
                // header("Location:index");    
            }
        }
      }
        echo $twig -> render('modifDev.html.twig',array('form'=>$form));
    }
?>