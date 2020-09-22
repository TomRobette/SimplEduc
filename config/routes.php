<?php
function getPage($db){
    $lesPages['accueil']="accueilControleur";
    
    

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
<<<<<<< HEAD
        return $lesPages['accueil'];
=======
        return $lesPages['maintenance'];
>>>>>>> 28e5a0ad305839e10fec837aae6aa1a9ebf7a690
    }
}
?>