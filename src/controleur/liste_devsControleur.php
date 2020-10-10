<?php
    function liste_devsControleur($twig, $db){

        $liste = array();

        $developpeur = new Developpeur($db);
        $liste = $developpeur->getDeveloppeurs();

        if(isset($_GET['supp'])){
            $exec=$developpeur->delete($_GET['supp']);
           
            if (!$exec){
                $etat = false;
            }else{
                $etat = true;
            }
            header('Location: index.php?page=liste_devs&etat='.$etat);
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
        $r = $developpeur->selectCount();
        $nb = $r['nb'];


        $liste = $developpeur->selectLimit($inf,$limite);
        $form['nbpages'] = ceil($nb/$limite);
        $form['nopage'] = $nopage;

        
        echo $twig -> render('liste_devs.html.twig',array('form'=>$form,'liste'=>$liste));
    
    }
?>