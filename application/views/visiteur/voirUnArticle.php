<?php
if ($this->session->statut==('Administrateur'))
{
    echo '<h2>'.$unArticle['LIBELLE'].'</h2>';
    echo $unArticle['DETAIL'];
    echo '<p>'.img($unArticle['NOMIMAGE']).'<p>'; 
    echo '<h3>Prix HT: '.$unArticle['PRIXHT'].'</h3>';
    echo '<h3>Quantité disponible: '.$unArticle['DISPONIBLE'].'</h3>';
    echo '<br><a href="'.site_url('administrateur/rendreIndisponible/'.$unArticle['NOPRODUIT']).'"><div class="btn btn-default btn-sm">Rendre indisponible</div></a>';
    echo '<br><a href="'.site_url('administrateur/modifierLeProduit/'.$unArticle['NOPRODUIT']).'"><div class="btn btn-default btn-sm">Modifier le produit</div></a>';
    echo '<p>'.anchor('visiteur/listerLesArticlesAvecPagination','Retour à la liste des articles').'</p>';
}
else {
    if ($unArticle['DISPONIBLE'] == 0) {

    }
    else {
        echo validation_errors();
        echo form_open('visiteur/voirUnArticle');
    }
    echo '<h2>'.$unArticle['LIBELLE'].'</h2>';
    echo $unArticle['DETAIL'];
    echo '<p>'.img($unArticle['NOMIMAGE']).'<p>'; 
    echo '<h3>Prix HT: '.$unArticle['PRIXHT'].'</h3>';
    echo '<h3>Quantité en stock: '.$unArticle['QUANTITEENSTOCK'].'</h3>';
    if ($unArticle['DISPONIBLE'] == 0) {
        echo 'Produit non disponible !';
        echo '<br>';
    }
    else {
        echo form_label('Quantité :  ','txtQuantite');
        echo form_input('txtQuantite', '', array('pattern' => '[0-9]*', 'required' => 'required'));
        echo form_hidden('slctNo', ''.$unArticle['NOPRODUIT'].'');
        echo form_submit('submit', 'Ajouter');
        echo '<p>'.anchor('visiteur/listerLesArticlesAvecPagination','Retour à la liste des articles').'</p>';
        echo form_close();
    }
    
}
?>
