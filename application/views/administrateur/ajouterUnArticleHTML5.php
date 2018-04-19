<h2><?php echo $TitreDeLaPage ?></h2>
 
<?php
 
echo form_open('administrateur/ajouterUnArticleHTML5');
 
echo form_label("Numéro de catégorie : ", 'lblNoCategorie');
echo form_input('txtNoCategorie','', array('pattern' => '[0-9]*', 'required'=>'required', 'title' => 'Saisir des nombres uniquement')).'<BR>';
 
echo form_label("Numéro de marque : ", 'lblMarque');
echo form_input('txtMarque', '', array('pattern' => '[0-9]*', 'required'=>'required', 'title' => 'Saisir des nombres uniquement')).'<BR>';
 
echo form_label("Libéllé du produit : ", 'lblLibelle');
echo form_input('txtLabelle', '', array('required' => 'required')).'<BR>';

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
<h2><?php echo $TitreDeLaPage ?></h2>

<?php echo validation_errors();

echo form_open('administrateur/ajouterUnArticle') ?>

<label for="txtTitre">Titre de l'article</label>
<input type="input" name="txtTitre" value="<?php echo set_value('txtTitre'); ?>" /><br/>

<label for="txtTexte">Texte de l'article</label>
<textarea name="txtTexte" value="<?php echo set_value('txtTexte'); ?>"></textarea><br/>

<label for="txtNomFichierImage">Nom du fichier Image</label>
<input type="input" name="txtNomFichierImage" value="<?php echo set_value('txtNomFichierImage'); ?>" /><br/>

<input type="submit" name="submit" value="Ajouter un article" />

</form>