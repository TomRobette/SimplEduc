<?php
    function projetControleur($twig, $db){

        $liste = array();
        $listeDevs = array();
        $form = array();
        if(isset($_GET['id'])){
            $projet = new Projet($db);
            $tache = new Tache($db);
            $unProjet = $projet->getProjetById($_GET['id']);
            $liste = $tache->getTachesFromProjet($_GET['id']);
            $listeDevs = $projet->getDevs($_GET['id']);
            
        }else{
            $form['message'] = 'Projet non précisé';
        }

        echo $twig -> render('projet.html.twig',array('form'=>$form,'liste'=>$liste, 'listeDevs'=>$listeDevs, 'projet'=>$unProjet));
    
    }
?>