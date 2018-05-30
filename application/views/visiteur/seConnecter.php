<!DOCTYPE html>
<html lang="en">
<head>
  <title>Skiny</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo site_url('../assets/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?php echo site_url('../assets/css/bootstrap.css') ?>">
  <script src="<?php echo site_url('../assets/js/jquery.min.js') ?>"></script>
  <script src="<?php echo site_url('../assets/js/bootstrap.min.js') ?>"></script>
  <style>
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>
<?php
echo validation_errors();
echo form_open('visiteur/unerecherche');
//var_dump($pageActuelle)
?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo site_url('visiteur/afficheracceuil') ?>"><img src="<?php echo site_url('../assets/images/logoskiny.jpg') ?>" width="70" height="25"></a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="<?php echo site_url('visiteur/afficheracceuil') ?>">Acceuil</a></li>
      <?php
      if ($this->session->statut==('Administrateur'))
     {
      echo '<li><a href="'.site_url('administrateur/ajouterUnArticle').'">Ajouter un produit</a></li>';
      echo '<li><a href="'.site_url('administrateur/listerLesArticles').'">Voir les articles</a></li>';
      echo '<li><a href="'.site_url('administrateur/listerLesCommandes').'">Afficher commandes non traitées</a></li>';
     }
    else {
      echo '<li><a href="'.site_url('visiteur/listerLesArticlesAvecPagination').'">Tous les produits</a></li>';
      echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Catégorie<span class="caret"></span></a>';
        echo '<ul class="dropdown-menu">';
          foreach ($lesCategories as $uneCategorie):
          echo '<li><a href="'.site_url('visiteur/listerLesArticlesParCategorie/'.$uneCategorie['NOCATEGORIE']).'">'.$uneCategorie['LIBELLE'].'</a></li>';
          endforeach;
        echo '</ul>';
      echo '</li>';
    echo '</ul>';
    }
     ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php
      if ($this->session->statut==('Client') OR $this->session->statut==(NULL))
      {
        echo '<li>';
        echo '<div class="form-group input-group">';
          echo form_input('recherche', '', array('pattern' => '[a-zA-Z]*', 'required' => 'required'));
          echo form_submit('submit', 'Rechercher');
        echo '</div>';
      echo '</li>';
      }
      ?>
      <?php if (!is_null($this->session->identifiant)) : ?>
       <?php echo '<li><a>Utilisateur connecté : '.$this->session->identifiant.'&nbsp;&nbsp;</a></li>';?>
       <li><a href="<?php echo site_url('visiteur/modifierCompte') ?>">Modifier votre compte</a></li>
       <li><a href="<?php echo site_url('visiteur/seDeconnecter') ?>">Se déconnecter</a></li>
          <?php else:
          echo '<li><a href="'.site_url('visiteur/sInscrire').'"><span class="glyphicon glyphicon-user"></span> S\'inscrire</a></li>';
          echo '<li><a href="'.site_url('visiteur/seConnecter').'"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li>';
          endif ?>
          <?php
          if ($this->session->statut==('Client') OR $this->session->statut==(NULL)) // 0 : statut visiteur
          {
            echo '<li><a href="'.site_url('visiteur/afficherPanier').'"><span class="glyphicon glyphicon-shopping-cart"></span>Panier</a>';
          }
        ?>
    </ul>
  </div>
</nav>

<div class="container">


    <?php
    /*
    if (!is_null($this->session->identifiant)) : ?>
       <?php echo 'Utilisateur connecté : <B>'.$this->session->identifiant.'</B>&nbsp;&nbsp;';?>
       <a href="<?php echo site_url('visiteur/seDeconnecter') ?>">Se déconnecter</a>&nbsp;&nbsp;
       <?php if ($this->session->statut=='Administrateur') : ?>
          <a href="<?php echo site_url('administrateur/ajouterUnArticle') ?>">Ajouter un article</a>&nbsp;&nbsp;
       <?php endif; ?>
    <?php else : ?>
       <a href="<?php echo site_url('visiteur/seConnecter') ?>">Se Connecter</a>&nbsp;&nbsp;
    <?php endif; ?>
    <a href="<?php echo site_url('visiteur/afficheracceuil') ?>">Lister tous les Articles</a>&nbsp;&nbsp;
    <a href="<?php echo site_url('visiteur/listerLesArticlesAvecPagination') ?>">Lister les Articles (par 3)</a>&nbsp;&nbsp;
    <?php echo form_close();
    */
    ?>
