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

    public function ajouterUnArticleHTML5()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');
      $DonneesInjectees['TitreDeLaPage'] = 'Ajouter un article';
             
      if ($this->input->post('boutonAjouter'))
      { 
        $donneesAInserer = array(
          'NOPRODUIT' => $this->input->post('txtNoProduit'),
          'NOCATEGORIE' => $this->input->post('txtNoCategorie'),
          'NOMARQUE' => $this->input->post('txtNoMarque'),
          'LIBELLE' => $this->input->post('txtLibelle'),
          'DETAIL' => $this->input->post('txtDetail'),
          'PRIXHT' => $this->input->post('txtPrixHT'),
          'TAUXTVA' => $this->input->post('txtTauxTVA'),
          'NOMIMAGE' => $this->input->post('txtNomImage'),
          'QUANTITEENSTOCK' => $this->input->post('txtQuantiteEnStock'),
          'DATEAJOUT' => $this->input->post('txtDateAjout'),
          'DISPONIBLE' => $this->input->post('txtDisponible')
        );
        $this->ModeleArticle->insererUnArticle($donneesAInserer);
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
