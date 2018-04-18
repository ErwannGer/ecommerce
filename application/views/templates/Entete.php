<html>
  <head>
    <title>Blog simple</title>
  </head>
  <body>

  <?php if (!is_null($this->session->identifiant)) : ?>
    <?php echo 'Utilisateur connecté : <B>'.$this->session->identifiant.'</B>&nbsp;&nbsp;';?>
      <a herf="<?php echo site_url('administrateur/ajouterUnArticle') ?>">Ajouter un article</a>&nbsp;&nbsp;
      <a herf="<?php echo site_url('administrateur/ajouterUnArticleHTML5') ?>">Ajouter un article (HTML5)</a>&nbsp;&nbsp;

  <?php else : ?>
    <a href="<?php echo site_url('visiteur/seConnecter') ?>">Se Connecter</a>&nbsp;&nbsp;
<?php endif; ?>

<a herf="<?php echo site_url('vistier/listerLesArticles') ?>">Lister tous les Articles</a>&nbsp;&nbsp;
<a herf="<?php echo site_url('visiteur/listerLesArticlesAvecPagination') ?>">Lister les Articles (par 3)</a>&nbsp;&nbsp;
