<h2><?php echo $TitreDeLaPage ?></h2>

<!--

$TitreDeLaPage : variable récupérée depuis le contrôleur

$lesArticles : variable récupérée depuis le contrôleur (en 'mode tableau associatif')

 -->

<?php foreach ($lesProduit as $unProduit):

     echo '<h3>'.anchor('Visiteur/ModeleProduit/'.$unProduit['cNo'],$unProduit['cTitre']).'</h3>';

endforeach ?>

<p>Pour avoir afficher le détail d'un produit, cliquer sur son titre</p>