<?php
echo '<h2>'.$unArticle['LIBELLE'].'</h2>';
echo $unArticle['DETAIL'];
echo '<p>'.img($unArticle['NOMIMAGE']).'<p>';
echo '<p>'.anchor('visiteur/listerLesArticles','Retour à la liste des articles').'</p>';
