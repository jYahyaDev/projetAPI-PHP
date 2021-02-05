<?php

/***Affiche 1 element****/

 if(isset($_GET['aliment']) && !empty($_GET['aliment'])){
        // Protection de la variable
        $id = htmlspecialchars($_GET['aliment']);
        $id = ucfirst($id); // Permet d'afficher la premiere lettre en majuscule
        $id = str_replace(' ', '+', $id);//Remplace l'espace vide par un "+"
        $url = "https://api.hmz.tf/?id=$id"; 
        $api = file_get_contents($url);     
        $json = json_decode($api,true);//true = tableau associatif 
        $array = $json['message']; // Récupere la partie du tableau avec tous les elements (sans le message de succes) 
      
    }

/***Affiche all ****/

    if(isset($_GET['items'])){
        $all = htmlspecialchars($_GET['items']);
        $url = "https://api.hmz.tf/?id=$all"; 
        $api = file_get_contents($url) ;     
        $json = json_decode($api,true);
        $array = $json['message'];
    
    }
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cette application est une aide-mémoire. Elle vous permet d'accéder rapidement à des informations pratiques liées à cet étonnant mode de cuisson">
    <!-- opengraph -->
    <meta property="og:title" content="Aide-mémoire : Vapeur douce">
    <meta property="og:site_name" content="Aide-mémoire : Vapeur douce">
    <meta property="og:url" content="https://salindres-rugby.000webhostapp.com/">
    <meta property="og:description" content="Cette application est une aide-mémoire. Elle vous permet d'accéder rapidement à des informations pratiques liées à cet étonnant mode de cuisson.">
    <meta property="og:type" content="siteweb">
    <meta property="og:image" content="https://salindres-rugby.000webhostapp.com/images/légumes.jpg">
    <!-- twittercard -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="https://salindres-rugby.000webhostapp.com/">
    <meta name="twitter:title" content="Aide-mémoire : Vapeur douce">
    <meta name="twitter:description" content="Cette application est une aide-mémoire. Elle vous permet d'accéder rapidement à des informations pratiques liées à cet étonnant mode de cuisson">
    <meta name=”twitter:image” content=”https://where-your-image-is-hosted/name.jpg” />
    
    <script src="https://kit.fontawesome.com/b3bd20c615.js" crossorigin="anonymous"></script>
    <link href="style.css" rel="stylesheet">
    <title>Aide-mémoire : Vapeur douce</title>
</head>


<body>
    <section class="project-hero"id="hero">
        <h1 class="project-hero__logo">Vapeur <span>Douce</span></h1>
        <div class="hero-content">

            <form action="index.php" method="get" >
                <input class="project-hero__input"type="text" name="aliment" placeholder="Entrer un aliment" >
                <input class="btn" type="submit" value="Afficher" >
                <button class="project-hero__btnAll btn"><a href="index.php?items=all">Tout afficher</a></button>
            </form>
        </div>

        <a href="#result"><i class="fas fa-angle-double-down project-hero__angles"></i></a>

    </section>
    <h2>Résultat de la recherche :</h2>

    <section class="project-result" id="result">
         <!-- bouton pour remonter vers le formulaire -->
        <a href="#hero"><i class="fas fa-angle-double-up project-hero__angles project-hero__angles--up"></i></a>

    <?php 

        if(isset($_GET['aliment'])&& !empty($_GET['aliment'])){
        
            if($json['status']=='success'){//Vérification du status pour validation de l'affichage

                echo "<div class='project-view'>
                
                <h2>".$array['nom']."</h2>";
                
                $info = $array['vapeur'];
                foreach($info as $method => $details){
                   
                echo "<p>$method : $details</p>";
                }
                echo "</div>";
                }else{
                    echo $json['message'];
                }
            }
            
        ;
        ?>

        <?php
        
        if(isset($_GET['items'])&& !empty($_GET['items'])){
            if($json['status']=='success'){//Vérification du status pour validation de l'affichage
             // 1ere boucle permets de recuperer le titre de chaque tableau ( aliments)
            // 2ieme boucle permets de recuperer la clé et la valeur de chaque tableau inclus au sein du tableau principal
            foreach($array as $titleAliment=>$content){
                // Création d'une div à chaque boucle affichage flexbox
                echo 
                "<div class='project-view'>
                    <h2>$titleAliment</h2>";
                  
                foreach($content as $method=>$details){
       
                 echo "<p>$method : $details</p>";
                }
                
                echo "</div>";
            }

             }else{
                    echo $json['message'];
                };
        }
        ?>
   

    </section>


<footer>
    <p>© 2020 LE J - Vapeur Douce</p>
</footer>    
</body>
</html>