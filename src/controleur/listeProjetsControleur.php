<?php
    function listeProjetsControleur($twig, $db){

        $liste = array();

        $projet = new Projet($db);
        $liste = $projet->getProjets();

        if(isset($_GET['id'])){
            $exec=$projet->delete($_GET['id']);
           
            if (!$exec){
                $etat = false;
            }else{
                $etat = true;
            }
            header('Location: index.php?page=listeProjets&etat='.$etat);
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
        $r = $projet->selectCount();
        $nb = $r['nb'];


        $liste = $projet->selectLimit($inf,$limite);
        $form['nbpages'] = ceil($nb/$limite);
        $form['nopage'] = $nopage;

        
        echo $twig -> render('listeProjets.html.twig',array('form'=>$form,'liste'=>$liste));
    
    }
?>