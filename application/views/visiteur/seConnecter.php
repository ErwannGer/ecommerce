<h2><?php echo $TitreDeLaPage ?></h2>
<?php

echo validation_errors();

echo form_open('visiteur/seconnecter');

echo form_label('Identifiant','txtEmail');
echo form_input('txtEmail', set_value('txtEmail'));
 
echo form_label('Mot de passe','txtMotDePasse');
echo form_password('txtMotDePasse', set_value('txtMotDePasse'));
 
echo form_submit('submit', 'Se connecter');
echo form_close();
?>

<p><a href="<?php echo site_url('Visiteur/creerUnCompte') ?>">Créer un compte</a><p>
