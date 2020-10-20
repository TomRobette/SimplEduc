<?php
    function clientControleur($twig, $db){

        $liste = array();
        $form = array();
        if(isset($_GET['id'])){
            $entreprise = new Entreprise($db);
            $uneEntreprise = $entreprise->getEntrepriseById($_GET['id']);
            $liste = $entreprise->getProjetsFromThis($_GET['id']);

            /*$limite=8;
            if(!isset($_GET['nopage'])){
                $inf=0;
                $nopage=0;
            }else{
                $nopage=$_GET['nopage'];
                $inf=$nopage * $limite;
            }
            $r = $entreprise->selectCountProj($_GET['id']);
            $nb = $r['nb'];

            $liste = $entreprise->selectLimitProj($inf,$limite, $_GET['id']);
            $form['nbpages'] = ceil($nb/$limite);
            $form['nopage'] = $nopage;*/
        }else{
            $form['message'] = 'Client non précisé';
        }

        echo $twig -> render('client.html.twig',array('form'=>$form,'liste'=>$liste, 'client'=>$uneEntreprise));
    
    }
?>