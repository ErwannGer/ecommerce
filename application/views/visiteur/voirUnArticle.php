<?php
echo '<h2>'.$unArticle['LIBELLE'].'</h2>';
echo $unArticle['DETAIL'];
echo '<p>'.img($unArticle['NOMIMAGE']).'<p>';
echo $unArticle['PRIXHT'].'<p>';
echo $unArticle['TAUXTVA'].'<p>';
echo $unArticle['QUANTITEENSTOCK'].'<p>';
echo $unArticle['DISPONIBLE'];
echo '<p>'.anchor('visiteur/listerLesArticles','Retour à la liste des articles').'</p>';
