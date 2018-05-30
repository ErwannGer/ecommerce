<h2><?php
  echo $TitreDeLaPage
 ?></h2>

<?php
if ($lesCommandes == NULL)
{
  echo ('<h3>Aucune commande à valider</h3>');
}
else
{
      foreach ($lesCommandes as $uneCommande):
            echo '<div><a href="'.site_url('administrateur/voirUneCommande/'.$uneCommande->NOCOMMANDE).'/'.$uneCommande->NOCLIENT.'"><h3>Commande n°'.$uneCommande->NOCOMMANDE.'</h3>';
            echo 'Du client n° '.$uneCommande->NOCLIENT.'';
            echo '</a></div>';
            echo '<br>';
            echo '<br>';
      endforeach;
 }
?>
