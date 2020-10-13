<?php
    function listeClientsControleur($twig, $db){

        $liste = array();

        $entreprise = new Entreprise($db);
        $liste = $entreprise->getEntreprises();

        if(isset($_GET['supp'])){
            $exec=$entreprise->delete($_GET['supp']);
           
            if (!$exec){
                $etat = false;
            }else{
                $etat = true;
            }
            header('Location: index.php?page=listeClients&etat='.$etat);
            exit;
        }

        $limite=8;
        if(!isset($_GET['nopage'])){
            $inf=0;
            $nopage=0;
        }else{
            $nopage=$_GET['nopage'];
            $inf=$nopage * $limite;
        }
        $r = $entreprise->selectCount();
        $nb = $r['nb'];


        $liste = $entreprise->selectLimit($inf,$limite);
        $form['nbpages'] = ceil($nb/$limite);
        $form['nopage'] = $nopage;

        
        echo $twig -> render('listeClients.html.twig',array('form'=>$form,'liste'=>$liste));
    
    }
?>