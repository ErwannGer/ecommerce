<html>

    <head>

        <title>Blog simple</title>

    </head>

<body>




<?php if (!is_null($this->session->identifiant)) : ?>

   <?php echo 'Utilisateur connecté : <B>'.$this->session->identifiant.'</B>&nbsp;&nbsp;';?>

   <a href="<?php echo site_url('visiteur/seDeconnecter') ?>">Se déconnecter</a>&nbsp;&nbsp;

   <?php if ($this->session->statut==1) : ?>

      <a href="<?php echo site_url('administrateur/ajouterUnProduit') ?>">Ajouter un produit</a>&nbsp;&nbsp;

   <?php endif; ?>

<?php else : ?>

   <a href="<?php echo site_url('visiteur/seConnecter') ?>">Se Connecter</a>&nbsp;&nbsp;

<?php endif; ?>

<a href="<?php echo site_url('visiteur/listerLesProduits') ?>">Lister tous les Produits</a>&nbsp;&nbsp;

<a href="<?php echo site_url('visiteur/listerLesProduitsAvecPagination') ?>">Lister les Produits (par 3)</a>&nbsp;&nbsp;