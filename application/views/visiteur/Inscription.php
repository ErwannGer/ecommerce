<h2><?php echo $TitreDeLaPage ?></h2>
<?php
echo validation_errors();
echo form_open('visiteur/Inscription');

echo '<br>';
echo form_label('Nom :','txtNom');
echo form_input('txtNom', '', array('pattern' => '[a-zA-Z]*', 'required' => 'required')).'<br>';

echo '<br>';
echo form_label('Prénom :','txtPrenom');
echo form_input('txtPrenom', '', array('pattern' => '[a-zA-Z]*', 'required' => 'required')).'<br>';

echo '<br>';
echo form_label('Adresse :','txtAdresse');
echo form_input('txtAdresse', '', array('pattern' => '[a-zA-Z0-9\ ]*', 'required' => 'required')).'<br>';

echo '<br>';
echo form_label('Ville :','txtVille');
echo form_input('txtVille', '', array('pattern' => '[a-zA-Z\-]*', 'required' => 'required')).'<br>';

echo '<br>';
echo form_label('Code postal :','txtCodePostal');
echo form_input(array('name' => 'txtCodePostal', 'value' => '', 'maxlength' => '5', 'minlength' => '5', 'pattern' => '[0-9]*', 'required' => 'required')).'<br>';

echo '<br>';
echo form_label('E-mail :','txtEmail');
echo form_input('txtEmail', '', array('pattern' => '[a-zA-Z0-9\@.]*', 'required' => 'required')).'<br>';

echo '<br>';
echo form_label('Mot de passe :','txtMDP');
echo form_password('txtMDP', '', array( 'pattern' => '[a-zA-Z0-9\*-]*', 'required' => 'required')).'<br>';

echo '<br>';
echo form_submit('boutonAjouter', 'S\'inscrire').'<BR>';
echo form_close();
?>
