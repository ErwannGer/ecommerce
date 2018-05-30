<?php
class Administrateur extends CI_Controller
{

  public function __construct()
  {
     parent::__construct();
     $this->load->model('ModeleArticle');
     $this->load->model('ModeleUtilisateur');
     $this->load->helper('url');
     $this->load->helper('form');
     $this->load->library('form_validation');
     $this->load->library('session');
     if ($this->session->statut==('Client') OR $this->session->statut==(NULL))
     {
        $this->load->helper('url');
        redirect('/visiteur/seConnecter'); 
     }
  }

  public function listerLesCommandes()
   {
      $DonneesInjectees['lesCommandes'] = $this->ModeleArticle->retournerCommandes();
      $DonneesInjectees['TitreDeLaPage'] = 'Les Commandes';

      $this->load->view('templates/Entete');
      $this->load->view('administrateur/listerCommandes', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
   }

  public function voirUneCommande($NoCommande, $NoClient)
  {
     $DonneesInjectees['Commande'] = $this->ModeleArticle->retournerUneCommande($NoCommande);
     $DonneesInjectees['Client'] = $this->ModeleUtilisateur->retournerUnUtilisateur($NoClient);
     $lesLignes = $this->ModeleArticle->retournerLesLignes($NoCommande);
     $Lignes = NULL;
     $i = 0;
     foreach ($lesLignes as $uneLigne):
       $Lignes[] = $this->ModeleArticle->retournerArticles($uneLigne['NOPRODUIT']);
       array_push($Lignes[$i], $lesLignes[$i]);
       $i = $i + "1";
     endforeach;
     $DonneesInjectees['Ligne'] = $Lignes;
     $DonneesInjectees['TitreDeLaPage'] = 'Les Commandes';
     $this->load->view('templates/Entete');
     $this->load->view('administrateur/voirCommande', $DonneesInjectees);
     $this->load->view('templates/PiedDePage');
  }

  public function validerCommande($NoCommande)
    {
      $laDate = date("Y-m-d H:i:s");
      $this->ModeleArticle->assignerValidation($NoCommande, $laDate);
      redirect('/administrateur/listerLesCommandes/'.$NoCommande.'');
    }

   public function rendreIndisponible($NoProduit)
   {
      $this->ModeleArticle->modifierDisponibilite($NoProduit);
      redirect('visiteur/voirUnArticle/'.$NoProduit.'');
   }

   public function modifierLeProduit($NoProduit)
   {
      $this->form_validation->set_rules('txtNoPorduit', 'NoProduit', 'required');
      $this->form_validation->set_rules('txtCategorie', 'NoCatégorie', 'required');
      $this->form_validation->set_rules('txtNoMarque', 'NoMarque', 'required');
      $this->form_validation->set_rules('txtLibelle', 'Libéllé', 'required');
      $this->form_validation->set_rules('txtDetail', 'Détail', 'required');
      $this->form_validation->set_rules('txtPrixHT', 'PrixHT', 'required');
      $this->form_validation->set_rules('txtTauxTVA', 'TauxTVA', 'required');
      $this->form_validation->set_rules('txtNomImage', 'NomImage', 'required');
      $this->form_validation->set_rules('txtQuantite', 'Quantité', 'required');
      $this->form_validation->set_rules('txtDisponible', 'Disponible', 'required');

      $Categories = $this->ModeleArticle->retournerCategories();
      $Marques = $this->ModeleArticle->retournerMarques();
      foreach ($Categories as $key => $uneCategorie):
        $LesCategories[$uneCategorie['NOCATEGORIE']] = $uneCategorie['LIBELLE'];
      endforeach;
      foreach ($Marques as $key => $uneMarque):
        $LesMarques[$uneMarque['NOMARQUE']] = $uneMarque['NOM'];
      endforeach;
      $DonneesInjectees['Categories'] = $LesCategories;
      $DonneesInjectees['Marques'] = $LesMarques;
      $DonneesInjectees['Article'] = $this->ModeleArticle->retournerArticles($NoProduit);
      $DonneesInjectees['TitreDeLaPage'] = 'Modifier le produit';

      if ($this->form_validation->run() === FALSE)
      {
        $this->load->view('templates/Entete');
        $this->load->view('administrateur/modifierArticle', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
      else
      {
        $donneesAInserer = array(
          'NOCATEGORIE' => $this->input->post('txtCategorie'),
          'NOMARQUE' => $this->input->post('txtMarque'),
          'LIBELLE' => $this->input->post('txtLibelle'),
          'DETAIL' => $this->input->post('txtDetail'),
          'PRIXHT' => $this->input->post('txtPrix'),
          'TAUXTVA' => $this->input->post('txtTauxTVA'),
          'NOMIMAGE' => $this->input->post('txtNomImage'),
          'QUANTITEENSTOCK' => $this->input->post('txtQuantite'),
          'DISPONIBLE' => $this->input->post('txtDisponible')
          );
          $this->ModeleArticle->modifierUnArticle($NoProduit, $donneesAInserer);
          redirect('administrateur/modifierLeProduit/'.$NoProduit.'');
      }
   }

   public function ajouterUnArticleHTML5()
   {
     $this->load->helper('form');
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
         'DISPONIBLE' => $this->input->post('txtDisponible'),
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
