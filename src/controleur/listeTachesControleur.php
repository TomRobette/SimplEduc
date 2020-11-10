<?php
    function listeTachesControleur($twig,$db)
    {
    
        $liste = array();

        $tache = new Tache($db);
        $liste = $tache->getTaches();

        if(isset($_GET['id'])){
            $exec=$tache->delete($_GET['id']);
           
            if (!$exec){
                $etat = false;
            }else{
                $etat = true;
            }
            header('Location: index.php?page=listeTaches&etat='.$etat);
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
        $r = $tache->selectCount();
        $nb = $r['nb'];


        $liste = $tache->selectLimit($inf,$limite);
        $form['nbpages'] = ceil($nb/$limite);
        $form['nopage'] = $nopage;

        
        echo $twig -> render('listeTaches.html.twig',array('form'=>$form,'liste'=>$liste));
    }
    
?>