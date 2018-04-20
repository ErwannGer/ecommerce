<h2><?php echo $TitreDeLaPage ?></h2>

<?php foreach ($lesArticles as $unArticle):
     echo '<h3>'.anchor('visiteur/voirUnArticle/'.$unArticle['LIBELLE'],$unArticle['DETAIL'],$unArticle['PRIXHT'],$unArticle['TAUXTVA'],$unArticle['NOMIMAGE'],$unArticle['QUANTITEENSTOCK'],$unArticle['DISPONIBLE']).'</h3>';
endforeach ?>
