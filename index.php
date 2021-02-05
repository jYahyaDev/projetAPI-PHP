<?php


if(isset($_GET['items'])){
$all = htmlspecialchars($_GET['items']);
$url = "https://api.hmz.tf/?id=$all"; // A REGLER : l'espace dans le input n'ajoute pas de "+" => requete fausse 
    $api = file_get_contents($url) ;     
    $json = json_decode($api,true);
   /*  echo "<pre>";
    print_r($json); */
    $array = $json['message']; // Récupere la partie du tableau avec tous les elements (sans le message de succes) */
 /*    echo "<pre>";
   print_r($array["Haricot azuki"]); */
}


/***Affiche 1 element****/

 if(isset($_GET['aliment']) && !empty($_GET['aliment'])){
        // Protection de la variable
        $id = htmlspecialchars($_GET['aliment']);
        $id = ucfirst($id); // Permet d'afficher la premiere lettre en majuscule
        $id = str_replace(' ', '+', $id);//Remplace l'espace vide par un "+"
        $url = "https://api.hmz.tf/?id=$id"; // l'espace dans le input n'ajoute pas de "+" => requete fausse 
        $api = file_get_contents($url) ;     
        $json = json_decode($api,true);//true = tableau associatif 
        $array = $json['message']; // Récupere la partie du tableau avec tous les elements (sans le message de succes) */
      
    }
    
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Vapeur douce</title>
</head>
<body>
    <section class="project-hero">
        <h1 class="project-hero__logo">Vapeur <span>Douce</span></h1>
        <div class="hero-content">

            <form action="index.php" method="get">
                <input class="project-hero__input"type="text" name="aliment" placeholder="Entrer un aliment">
                <input class="btn"type="submit" value="Affiche">
                <button class="project-hero__btnAll btn"><a href="index.php?items=all">Tout afficher</a></button>
            </form>
        
        </div>
    </section>
    <h2>Résultat de la recherche</h2>
    <section class="project-result">

    <?php 

        if(isset($_GET['aliment'])&& !empty($_GET['aliment'])){
        
        echo "<div class='project-view'>
        
        <h2>".$array['nom']."</h2>";
        
        $info = $array['vapeur'];
        foreach($info as $method => $details){
           
        echo "<p>$method : $details</p>";
        }
        echo "</div>";
        }

        ?>

        <?php
       if(isset($_GET['items'])&& !empty($_GET['items'])){

             // 1ere boucle permets de recuperer le titre de chaque tableau ( aliments)
            // 2ieme boucle permets de recuperer la clé et la valeur de chaque tableau inclus au sein du tableau principal
            foreach($array as $titleAliment=>$content){
                // Création d'une div à chaque boucle
                echo 
                "<div class='project-view'>
                    <h2>$titleAliment</h2>";
                  
                foreach($content as $method=>$details){
       
                 echo "<p>$method : $details</p>";
                }
                
                echo "</div>";
            }
        }
   ?>
   
     
         
  


    </section>
</body>
</html>