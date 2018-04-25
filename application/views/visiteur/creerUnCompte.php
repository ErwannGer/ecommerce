<h2><?php echo $TitreDeLaPage ?></h2>

<?php
 
 echo form_open('visiteur/creerUnCompte');
   
 echo form_label("Nom : ", 'lblNom');
 echo form_input('txtNom','', array('pattern' => '[a-zA-Z]*', 'required'=>'required', 'title' => 'Saisir uniquement des lettres')).'<BR>';
 
 echo form_label("Prénom : ", 'lblPrenom');
 echo form_input('txtPrenom','', array('pattern' => '[a-zA-Z]*', 'required'=>'required', 'title' => 'Saisir uniquement des lettres')).'<BR>';
  
 echo form_label("Adresse : ", 'lblAdresse');
 echo form_input('txtAdresse','', array('pattern' => '[a-zA-Z0-9]*', 'required'=>'required')).'<BR>';
 
 echo form_label("Ville : ", 'lblVille');
 echo form_input('txtVille','', array('pattern' => '[a-zA-Z]*', 'required'=>'required', 'title' => 'Saisir uniquement des lettres')).'<BR>';
  
 echo form_label("Code postal : ", 'lblCodePostal');
 echo form_input('txtCodePostal','', array('pattern' => '[0-9]*', 'required'=>'required', 'title' => 'Saisir uniquement des nombres')).'<BR>';
  
 echo form_label("Email : ", 'lblEmail');
 echo form_input('txtEmail','', array('pattern' => '[a-zA-Z0-9]*', 'required'=>'required')).'<BR>';
 
 echo form_label("Mot de passe : ", 'lblMotDePasse');
 echo form_input('txtMotDePasse','', array('pattern' => '[a-zA-Z0-9]*', 'required'=>'required', 'title' => 'Saisir uniquement des lettres')).'<BR>';
 
 echo form_close();

 ?>
 
 <p><a href="<?php echo site_url('Visiteur/creationReussie') ?>">Créer un compte</a><p>
