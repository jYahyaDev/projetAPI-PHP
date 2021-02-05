
<?php
//Traitement du formulaire : 

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

   
   




?>
