<h2><?php echo $TitreDeLaPage ?></h2>

<?php foreach ($lesArticles as $unArticle):
     echo '<h3>'.anchor('visiteur/voirUnArticle/'. $unArticle['NOPRODUIT'], $unArticle['LIBELLE']).'</h3>';
endforeach ?>
