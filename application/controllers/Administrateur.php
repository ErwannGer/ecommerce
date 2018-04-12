<?php
class Administrateur extends CI_Controller {

public function __construct()
{
   parent::__construct();
   $this->load->model('ModeleArticle');

   $this->load->library('session');
   if ($this->session->statut==0)
   {
$this->load->helper('url');
redirect('/visiteur/seConnecter');
   }
}

public function ajouterUnArticle()
{
    $this->load->helper('form');
    $this->load->library('form_validation');

    $DonneesInjectees['TitreDeLaPage'] = 'Ajouter un article';

    $this->form_validation->set_rules('txtTitre', 'Titre', 'required');
    $this->form_validation->set_rules('txtTexte', 'Texte', 'required');

    if ($this->form_validation->run() === FALSE)
$this->load->view('templates/Entete');
$this->load->view('administrateur/ajouterUnArticle', $DonneesInjectees);
$this->load->view('templates/PiedDePage');
    }
    else
    {
   $donneesAInserer = array(
 'cTitre' => $this->input->post('txtTitre'),
 'cTexte' => $this->input->post('txtTexte'),
 'cNomFichierImage' => $this->input->post('txtNomFichierImage')
   $this->ModeleArticle->insererUnArticle($donneesAInserer);
   $this->load->helper('url');
   $this->load->view('administrateur/insertionReussie');
    }
}
}
