<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
      .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    
  .carousel-inner img {
      width: 100%;
      margin: auto;
      min-height:200px;
  }

  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo site_url('visiteur/accueil') ?>">Acceuil</a></li>
        <?php if (!is_null($this->session->identifiant)) : ?>
       <?php echo 'Utilisateur connecté : <B>'.$this->session->identifiant.'</B>';?>
       <?php if ($this->session->statut==('Admin')) { ?>
        <li><a href="<?php echo site_url('administrateur/ajouterUnArticle') ?>">Ajouter un article</a></li>
       <?php } ?>
       <?php endif; ?>
        <li><a href="<?php echo site_url('visiteur/listerLesArticles') ?>">Articles</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li><a href="<?php echo site_url('visiteur/afficherPanier') ?>">Panier</a></li>
        <?php if (!is_null($this->session->identifiant)) : ?> 
        <li><a href="<?php echo site_url('visiteur/seDeconnecter') ?>"><span class="glyphicon glyphicon-log-in"></span>  Se déconnecter</a></li>
        <?php else : ?>
        <li><a href="<?php echo site_url('visiteur/seConnecter') ?>"></span>  Se connecter</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
