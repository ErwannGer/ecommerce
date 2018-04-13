<?php

echo '<h2>'.$unProduit['cTitre'].'</h2>';

echo $unProduit['cTexte'];

echo '<p>'.img($unProduit['cNomFichierImage']).'<p>'; // Affiche directement l'image

// Nota Bene : img_url($unArticle['cNomFichierImage']) aurait retourne l'url de l'image (cf. assets)

echo '<p>'.anchor('visiteur/listerLesProduit','Retour à la liste des produits').'</p>';