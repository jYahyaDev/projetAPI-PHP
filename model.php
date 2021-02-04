
<?php
//Traitement du formulaire : 

if(isset($_GET['aliment']) && !empty($_GET['aliment'])){
    // Protection de la variable
    $id = htmlspecialchars($_GET['aliment']);
    $id = ucfirst($id);
    echo $id;
    $url = "https://api.hmz.tf/?id=$id"; // l'espace dans le input n'ajoute pas de "+" => requete fausse 
    echo $url;
    $api = file_get_contents($url) ;     
    $json = json_decode($api);
    echo "<pre>";
    print_r($json);

}

 



?>
