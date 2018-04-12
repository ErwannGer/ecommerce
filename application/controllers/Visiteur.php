<?php
class Visiteur extends CI_Controller {

   public function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('assets');
      $this->load->library("pagination");
      $this->load->model('ModeleArticle');
      $this->load->model('ModeleUtilisateur');
   }

   public function listerLesArticles()
   {
      $DonneesInjectees['lesArticles'] = $this->ModeleArticle->retournerArticles();
      $DonneesInjectees['TitreDeLaPage'] = 'Tous les articles';

      $this->load->view('templates/Entete');
      $this->load->view('visiteur/listerLesArticles', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
   }

   public function seConnecter()
   {
     $this->load->helper('form');
     $this->load->library('form_validation');

     $DonneesInjectees['TitreDeLaPage'] = 'Se  connecter';

     $this->form_validation->set_rules('txtIdentifiant', 'Identifiant', 'required');
     $this->form_validation->set_rules('txtMotDePasse', 'Mot de passe', 'required');

     if ($this->form_validation->run() === FALSE)
     {
       $this->load->view('templates/Entete');
       $this->load->view('visiteur/seConnecter', $DonneesInjectees); // on renvoie le formulaire
       $this->load->view('templates/PiedDePage');
      }
      else
      {
        $Utilisateur = array(
          'cIdentifiant' => $this->input->post('txtIdentifiant'),
          'cMotDePasse' => $this->input->post('txtMotDePasse'),
        );

        $UtilisateurRetourne = $this->ModeleUtilisateur->retournerUtilisateur($Utilisateur);
        if (!($UtilisateurRetourne == null))
        {
          $this->load->library('session');
          $this->session->identifiant = $UtilisateurRetourne->cIdentifiant;
          $this->session->statut = $UtilisateurRetourne->cStatut;

          $DonneesInjectees['Identifiant'] = $Utilisateur['cIdentifiant'];
          $this->load->view('templates/Entete');
          $this->load->view('visiteur/connexionReussie', $DonneesInjectees);
          $this->load->view('templates/PiedDePage');
        }
        else
        {
          $this->load->view('templates/Entete');
          $this->load->view('visiteur/seConnecter', $DonneesInjectees);
          $this->load->view('templates/PiedDePage');
        }

      }
    }

    public function seDeConnecter() {
        $this->session->sess_destroy();
    }

    public function listerLesArticlesAvecPagination() {

      $config = array();
      $config["base_url"] = site_url('visiteur/listerLesArticlesAvecPagination');
      $config["total_rows"] = $this->ModeleArticle->nombreDArticles();
      $config["per_page"] = 3;
      $config["uri_segment"] = 3;

      $config['first_link'] = 'Premier';
      $config['last_link'] = 'Dernier';
      $config['next_link'] = 'Suivant';
      $config['prev_link'] = 'Précédent';

      $this->pagination->initialize($config);

      $noPage = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

      $DonneesInjectees['TitreDeLaPage'] = 'Les articles, avec pagination';
      $DonneesInjectees["lesArticles"] = $this->ModeleArticle->retournerArticlesLimite($config["per_page"], $noPage);
      $DonneesInjectees["liensPagination"] = $this->pagination->create_links();

      $this->load->view('templates/Entete');
      $this->load->view("visiteur/listerLesArticlesAvecPagination", $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
}
