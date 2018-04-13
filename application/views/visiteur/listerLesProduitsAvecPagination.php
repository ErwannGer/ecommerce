<h2><?php echo $TitreDeLaPage ?></h2>

<!-- données récupérées en 'mode objet' -->

 

<?php foreach ($lesArticles as $unArticle):

     echo '<h3>'.anchor('visiteur/voirUnProduit/'.$unArticle->cNo,$unProduit->cTitre).'</h3>';

endforeach ?>

 

<p>Pour avoir afficher le détail d'un produit, cliquer sur son titre</p>

 

<p><?php echo $liensPagination; ?></p>