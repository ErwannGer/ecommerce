<h2><?php echo $TitreDeLaPage ?></h2>
<?php
echo validation_errors();

echo form_open('visiteur/seconnecter');

echo form_label('Identifiant','txtIdentifiant');
echo form_input('txtIdentifiant', set_value('txtIdentifiant'));
 
echo form_label('Mot de passe','txtMotDePasse');
echo form_password('txtMotDePasse', set_value('txtMotDePasse'));
 
echo form_submit('submit', 'Se connecter');
echo form_close();
?>