<?php
class Administrateur extends CI_Controller {
    public function ajouterUnArticleHTML5()
    {
      $this->load->helper('form');
      $DonneesInjectees['TitreDeLaPage'] = 'Ajouter un article';
             
      if ($this->input->post('boutonAjouter')) // On test si le formulaire a été posté.
      {
        // le bouton 'submit', boutonAjouter est <> de NULL, on a posté quelque chose.
        $donneesAInserer = array(
          'cTitre' => $this->input->post('txtTitre'),
          'cTexte' => $this->input->post('txtTexte'),
          'cNomFichierImage' => $this->input->post('txtNomFichierImage')
        ); // cTitre, cTexte, cNomFichierImage : champs de la table tabarticle
        $this->ModeleArticle->insererUnArticle($donneesAInserer); // appel du modèle
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        $this->load->view('administrateur/insertionReussie');
      }
      else
      {  
        /* si formulaire non posté = bouton 'submit' à NULL : on est jamais passé par le formulaire -> on envoie le formulaire */
        $this->load->view('templates/Entete');
        $this->load->view('administrateur/ajouterUnArticleHTML5', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
    } // ajouterUnArticleHTML5
}