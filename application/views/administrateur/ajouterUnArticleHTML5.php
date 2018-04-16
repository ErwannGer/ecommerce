<h2><?php echo $TitreDeLaPage ?></h2>

<?php

echo form_open('administrateur/ajouterUnArticleHTML5');

echo form_label("Titre de l'article : ", 'lblTitre');
echo form_input('txtTitre', '', array('pattern' =>'[a-zA-Z]*','required'=>'required', 'title'=>'Saisie des lettres uniquement')).'<BR>';

echo form_label("Texte de l'article : ", 'lblTexte');
echo form_textearea('txtTexte', '', array('required'=>'required')).'<BR>';

echo form_label('Nom du fichier Image : ', 'lblNomFichierImage');
echo form_input('txtNomFichierImage', '', array('pattern'=>'^[a-zA-Z][a-zA-Z0-9]*','title'=>'Un nom de fichier doit commencer par une lettre', 'required'=>'required')).'<BR>';

echo form_submit('boutonjouter', 'Ajouter un article').'<BR>';
echo form_close();

?>