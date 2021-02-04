<?php
/* include("all.php"); */


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
        <div class="hero-content">
            <h1>Vapeur <span>Douce</span></h1>

            <form action="model.php" method="get">
                <input type="text" name="aliment" placeholder="Entrer un aliment">
                <input type="submit" value="Afficher">
                <a href="index.php?items=all">Tout afiicher</a>
            </form>
        
        </div>
    </section>
    <h2>Résultat de la recherche</h2>
    <section class="project-result">


  
        <?php
        if(isset($_GET['items'])){
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