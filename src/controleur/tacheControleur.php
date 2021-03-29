<?php
    function tacheControleur($twig, $db){

        $liste = array();
        $form = array();
        if(isset($_GET['id'])){
            $tache = new Tache($db);
            $uneTache = $tache->getTacheById($_GET['id']);
            $liste = $tache->getDevsByTache($_GET['id']);
        }else{
            $form['message'] = 'Tache non précisé';
        }

        echo $twig -> render('tache.html.twig',array('form'=>$form,'liste'=>$liste, 'tache'=>$uneTache));
    
    }
?>