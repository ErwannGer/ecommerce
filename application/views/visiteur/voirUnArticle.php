<?php
echo '<h2>'.$unArticle['cTitre'].'</h2>';
echo $unArticle['cTexte'];
echo '<p>'.img($unArticle['cNomFichierImage']).'<p>';
echo '<p>'.anchor('visiteur/listerLesArticles','Retour à la liste des articles').'</p>';
