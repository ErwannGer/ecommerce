<?php
class Administrateur extends CI_Controller
{
   public function ajouterUnArticleHTML5()
    {
        $this->load->helper('form');
        $DonneesInjectees['TitreDeLaPage']='Ajouter un article';

        if ($this->input-post('boutonAjouter'))
        {
            $donneesAInserer = array(
                'cTitre' => $this->input->post('txtTitre'),
                'cTexte' => $this->input->post('txtTexte'),
                'cNomFichierImage' => $this->input->post('txtNomFichierImage')
            );
            $this->ModelArticle->insererUnArticle($donneesAInserer);
            $this->load->helper('url');
            $this->load->view('administrateur/insertionReussie');
        }
        else
        {
            $this->load->view('templates/Entete');
            $this->load->view('administrateur/ajouterUnArticleHTML5', $DonneesInjectees);
            $this->load->view('templates/PiedDePage');
        }
    }
}