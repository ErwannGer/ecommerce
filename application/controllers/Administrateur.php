<?php
class Administrateur extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModeleArticle');
    $this->load->library('session');
    if ($this->session->EMAIL=='pigeaon.philipe@outlook.fr')
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
             
      $this->form_validation->set_rules('txtNoProduit', 'NoProduit', 'required');
      $this->form_validation->set_rules('txtNoCategorie', 'NoCategorie', 'required');
      $this->form_validation->set_rules('txtNoMarque', 'NoMarque', 'required');
      $this->form_validation->set_rules('txtLibelle', 'Libelle', 'required');
      $this->form_validation->set_rules('txtDetail', 'Detail', 'required');
      $this->form_validation->set_rules('txtPrixHT', 'PrixHT', 'required');
      $this->form_validation->set_rules('txtTauxTVA', 'TauxTVA', 'required');
      $this->form_validation->set_rules('txtNomImage', 'NomImage', 'required');
      $this->form_validation->set_rules('txtQuantiteEnStock', 'QuantiteEnStock', 'required');
      $this->form_validation->set_rules('txtDateAjout', 'DateAjout', 'required');
      $this->form_validation->set_rules('txtDisponible', 'Disponible', 'required');
 
      if($this->input->post('boutonAjouter'))
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
