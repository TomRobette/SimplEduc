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
        $inputMdp = $_POST['inputMdp'];
        $inputMdp2 = $_POST['inputMdp2'];
        $form['valide'] = true;    
        //die(var_dump($inputNom, $inputPrenom, $inputDate_embauche, $inputCout_horaire, $inputAdr_ville, $inputAdr_cp, $inputAdr_rue, $inputAdr_no));  

        if ($inputMdp!=$inputMdp2){        
          $form['valide'] = false;          
          $form['message'] = 'Les mots de passe sont différents';      
        }else{
          $dev=new Developpeur($db);
          $exec=$dev->insert($inputNom, $inputPrenom, $inputDate_embauche, $inputCout_horaire, $inputAdr_ville, $inputAdr_cp, $inputAdr_rue, $inputAdr_no, password_hash($inputMdp,PASSWORD_DEFAULT));
          //die(var_dump($exec));
          if(!$exec){
            $form['valide'] = false;
            $form['message'] = 'Problème d\'insertion dans la table développeur ';
          }else{ 
            header("Location:index.php?page=liste_devs");    
          }
        }  
      }
        echo $twig -> render('ajoutDev.html.twig',array('form'=>$form));
    }
?>