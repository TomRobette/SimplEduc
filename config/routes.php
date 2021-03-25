<?php
function getPage($db){
    $lesPages['accueil']="accueilControleur";
    $lesPages['maintenance']="maintenanceControleur";
    $lesPages['listeProjets']="listeProjetsControleur";
    $lesPages['ajoutDev']="ajoutDevControleur";
    $lesPages['liste_devs']="liste_devsControleur";
    $lesPages['modifDev']="modifDevControleur";
    $lesPages['listeClients']="listeClientsControleur";
    $lesPages['ajoutClient']="ajoutClientControleur";
    $lesPages['client']="clientControleur";
    $lesPages['projet']="projetControleur";
    $lesPages['tache']="tacheControleur";
    
    

    if($db!=NULL){
        if(isset($_GET['page'])) {
            $page=$_GET['page'];
        }else{
            $page='accueil';
        }
    
        if(isset($lesPages[$page])){
            $contenu=$lesPages[$page];
        
        }else{
            $contenu=$lesPages['accueil'];
        }
    
        return $contenu;
    }else{
        return $lesPages['maintenance'];
    }
}
?>