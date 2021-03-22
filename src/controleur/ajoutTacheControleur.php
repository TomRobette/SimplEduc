<?php
    function ajoutTacheControleur($twig,$db){
        $form = array();    
        $listeProjets = array();
        $projet = new Projet($db);
        $listeProjets = $projet->getProjets();
        
        if (isset($_POST['btPoster'])){  
            $inputLibelle = $_POST['inputLibelle'];
            $inputTempsTache = $_POST['inputTempsTache'];
            $inputStatus = $_POST['inputStatus'];
            $inputCout = $_POST['inputCout'];
            $inputProjet = $_POST['inputProjet'];
            $inputDateDebut = $_POST['inputDateDebut'];
            $inputDateFin = $_POST['inputDateFin'];
            $form['valide'] = true;      
            $tache=new Tache($db);
            $exec=$tache->insert($inputLibelle, $inputTempsTache, $inputStatus, $inputCout, $inputProjet, $inputDateDebut, $inputDateFin);
            if(!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table Tache ';
            }
            
        }
        echo $twig -> render('ajoutTache.html.twig',array('projets'=>$listeProjets));
    }
?>