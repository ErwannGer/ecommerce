<h2><?php echo $TitreDeLaPage ?></h2>

<?php foreach ($lesArticles as $unArticle):
     echo '<h3>'.anchor('visiteur/voirUnArticle/'. $unArticle['NOPRODUIT'], $unArticle['LIBELLE']).'</h3>';
     echo '<h3>Prix HT : '.$unArticle['PRIXHT'].'</h3>';
     endforeach?>

