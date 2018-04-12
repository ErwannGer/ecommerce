<?php
class Exos extends CI_Controller {
  public function __construct()
  {
     parent::__construct();
     $this->load->library('pagination');
     $this->load->helper('url');
     $this->load->helper('assets');
     $this->load->model('ModeleTest');
  }

   public function ajouterFormation()
  {
      $this->load->helper('form');
      $this->load->library('form_validation');
      $DonneesInjectees['TitreDeLaPage'] = 'Ajouter une Formation';
      $this->form_validation->set_rules('txtNom', 'Texte', 'required');
      $this->form_validation->set_rules('txtTexte', 'Texte', 'required');
      if ($this->form_validation->run() === FALSE)
      {
        $this->load->view('ajouterFormation.php', $DonneesInjectees);
      }
      else
      {
        $donneesAInserer = array(
        'libelle' => $this->input->post('txtNom'),
        'description' => $this->input->post('txtTexte'),
     );
      $this->ModeleTest->insertion($donneesAInserer);
      $this->load->helper('url');
      $this->load->view('insertionReussie.php');
      }
  }
  public function index() // lister tous les articles
   {

      $DonneesInjectees['lesformations'] = $this->ModeleTest->retournerFormations();
      $DonneesInjectees['TitreDeLaPage'] = 'Toutes les Formations';
      $this->twig->display('listerLesFormations.twig', $DonneesInjectees);
   }
   public function VoirUneFormation($noFormation = NULL) // valeur par défaut de noArticle = NULL
{
  $DonneesInjectees['uneFormation'] = $this->ModeleTest->retournerFormations($noFormation);
  if (empty($DonneesInjectees['uneFormation']))
  {
      show_404();
  }
  $DonneesInjectees['TitreDeLaPage'] = $DonneesInjectees['uneFormation']['libelle'];
  $this->twig->display('VoirUneFormation.twig', $DonneesInjectees);
}
public function listerLesFormationsAvecPagination() {
   $config = array();
   $config["base_url"] = site_url('Exos/listerLesFormationsAvecPagination');
   $config["total_rows"] = $this->ModeleTest->nombreFormation();
   $config["per_page"] = 3;
   $config["uri_segment"] = 3;
   $config['first_link'] = ' Premier ';
   $config['last_link'] = ' Dernier ';
   $config['next_link'] = ' Suivant ';
   $config['prev_link'] = ' Précédent  ';
   $this->pagination->initialize($config);
   $noPage = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
   $DonneesInjectees['TitreDeLaPage'] = 'Les Formations, avec pagination';
   $DonneesInjectees["lesformations"] = $this->ModeleTest->retournerFormationsLimite($config["per_page"], $noPage);
   $DonneesInjectees["liensPagination"] = $this->pagination->create_links();
   $this->twig->display("Contenu.twig", $DonneesInjectees);
}
}
