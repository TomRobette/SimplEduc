<?php
    function clientControleur($twig, $db){

        $liste = array();

        $entreprise = new Entreprise($db);
        $liste = $entreprise->getProjetsFromThis();

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

        
        echo $twig -> render('client.html.twig',array('form'=>$form,'liste'=>$liste));
    
    }
?>