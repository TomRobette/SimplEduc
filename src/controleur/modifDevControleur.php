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
            $inputMdp = $_POST['inputMdp'];
            $inputMdp2 = $_POST['inputMdp2'];
            $form['valide'] = true;    
            if ($inputMdp!=$inputMdp2){        
                $form['valide'] = false;          
                $form['message'] = 'Les mots de passe sont différents';      
            }else{
                if($inputMdp==null || $inputMdp=="" || strlen($inputMdp)==0){
                    $exec=$dev->modify($inputNom, $inputPrenom, $inputDate_embauche, $inputCout_horaire, $inputAdr_ville, $inputAdr_cp, $inputAdr_rue, $inputAdr_no, password_hash("bruh",PASSWORD_DEFAULT));
                }else{
                    $exec=$dev->modify($inputNom, $inputPrenom, $inputDate_embauche, $inputCout_horaire, $inputAdr_ville, $inputAdr_cp, $inputAdr_rue, $inputAdr_no, password_hash($inputMdp,PASSWORD_DEFAULT));
                }
                if(!$exec){
                    $form['valide'] = false;
                    $form['message'] = 'Problème d\'insertion dans la table développeur ';
                }else{ 
                    // header("Location:index");    
                }
            }    
        }
      }
        echo $twig -> render('modifDev.html.twig',array('form'=>$form));
    }
?>