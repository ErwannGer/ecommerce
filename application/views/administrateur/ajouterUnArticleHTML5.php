<h2><?php echo $TitreDeLaPage ?></h2>
 
<?php
 
echo form_open('administrateur/ajouterUnArticleHTML5');
 
echo form_label("Numéro du produit: ", 'lblNoProduit');
echo form_input('txtNoProduit','', array('pattern' => '[0-9]*', 'required'=>'required', 'title' => 'Saisir des nombres uniquement')).'<BR>';
 
echo form_label("Numéro de catégorie : ", 'lblNoCategorie');
echo form_input('txtNoCategorie','', array('pattern' => '[0-9]*', 'required'=>'required', 'title' => 'Saisir des nombres uniquement')).'<BR>';
 
echo form_label("Numéro de marque : ", 'lblNoMarque');
echo form_input('txtNoMarque', '', array('pattern' => '[0-9]*', 'required'=>'required', 'title' => 'Saisir des nombres uniquement')).'<BR>';
 
echo form_label("Libéllé du produit : ", 'lblLibelle');
echo form_input('txtLibelle', '', array('required' => 'required')).'<BR>';

echo form_label("Détail du produit : ", 'lblDetail');
echo form_textarea('txtDetail', '', array('required' => 'required')).'<BR>';

echo form_label("Prix HT du produit : ", 'lblPrixHT');
echo form_input('txtPrixHT', '', array('[0-9]*', 'required' => 'required', 'title' => 'Saisir des nombres uniquement')).'<BR>';

echo form_label("Taux TVA du produit : ", 'lblTauxTVA');
echo form_input('txtTauxTVA', '', array('[0-9]*', 'required' => 'required', 'title' => 'Saisir des nombres uniquement')).'<BR>';

echo form_label("Nom du fichier image du produit : ", 'lblNomImage');
echo form_input('txtNomImage', '', array('required' => 'required')).'<BR>';

echo form_label("Quantité en stock du produit : ", 'lblQuantiteEnStock');
echo form_input('txtQuantiteEnStock', '', array('[0-9]*', 'required'=>'required', 'title' => 'Saisir des nombres uniquement')).'<BR>';

echo form_label("Date d'ajout du produit : ", 'lblDateAjout');
echo form_input('txtDateAjout', '', array('required' => 'required')).'<BR>';

echo form_label("Nombre disponible de produit : ", 'lblDisponible');
echo form_input('txtDisponible', '', array('[0-9]*', 'required' => 'required', 'title' => 'Saisir des nombres uniquement')).'<BR>';

echo form_submit('boutonAjouter', 'Ajouter un article').'<BR>';
echo form_close();
 
?>