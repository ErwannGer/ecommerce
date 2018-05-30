<h2><?php echo $TitreDeLaPage ?></h2>
<?php
echo validation_errors();
echo form_open('visiteur/modifierCompte');

echo '<br>';
echo form_label('Nom ','txtNom');
echo form_input(array('name' => 'nom', 'value' => $Infos['NOM'], 'size' => '20', 'pattern' => '[a-zA-Z]*', 'required' => 'required')).'<br>';

echo '<br>';
echo form_label('Prénom ','txtPrenom');
echo form_input(array('name' => 'prenom', 'value' => $Infos['PRENOM'], 'size' => '20', 'pattern' => '[a-zA-Z]*', 'required' => 'required')).'<br>';

echo '<br>';
echo form_label('Adresse ','txtAdresse'); 
echo form_input(array('name' => 'adresse', 'value' => $Infos['ADRESSE'], 'size' => '30', 'pattern' => '[a-zA-Z0-9\- ]*', 'required' => 'required')).'<br>';

echo '<br>';
echo form_label('Ville ','txtVille');
echo form_input(array('name' => 'ville', 'value' => $Infos['VILLE'], 'size' => '25', 'pattern' => '[a-zA-Z\- ]*', 'required' => 'required')).'<br>';

echo '<br>';
echo form_label('Code Postal ','txtCodePostal');
echo form_input(array('name' => 'codepostal', 'value' => $Infos['CODEPOSTAL'], 'maxlength' => '5', 'minlength' => '5', 'size' => '5', 'pattern' => '[0-9]*', 'required' => 'required')).'<br>';

echo '<br>';
echo form_label('E-Mail ','txtEmail');
echo form_input(array('name' => 'email', 'value' => $Infos['EMAIL'], 'size' => '25', 'pattern' => '[a-zA-Z0-9\-@_.]*', 'required' => 'required')).'<br>';

echo '<br>';
echo form_label('Mot de passe (5 caractères minimum) ','txtMdp'); 
echo form_input(array('name' => 'mdp', 'value' => $Infos['MOTDEPASSE'], 'minlength' => '4', 'size' => '20', 'pattern' => '[a-zA-Z0-9\*-]*', 'required' => 'required')).'<br>';

echo '<br>';
echo form_submit('submit', 'Appliquer');
echo form_close();
?>
