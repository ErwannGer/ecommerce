<h2>Connexion réussie !</h2>
<?php echo '<p>Bienvenue '.$Identifiant.' !</p>';

if($this->session->EMAIL=='pigeaon.philipe@outlook.fr' )
?>
<p><a href="<?php echo site_url('Visiteur/ListerLesArticles') ?>">Voir la liste des articles</a><p>