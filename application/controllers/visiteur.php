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
      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->load->library('session');
      $this->load->library('cart');
      $this->load->library('email');

   }

   public function afficheracceuil()
   {
      $DerniereDate = $this->ModeleArticle->retournerDerniereDate();
      $DonneesInjectees['unArticle'] = $this->ModeleArticle->retournerDernierArticle($DerniereDate['MAX(DATEAJOUT)']);
      $DonneesInjectees['TitreDeLaPage'] = 'Acceuil';

        $this->load->view('templates/Entete');
        $this->load->view('visiteur/accueil', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
   }


   public function listerLesArticles()
   {

      $DonneesInjectees['lesArticles'] = $this->ModeleArticle->retournerArticles();
      $DonneesInjectees['TitreDeLaPage'] = 'Tous les articles';

      $this->load->view('templates/Entete');
      $this->load->view('visiteur/listerLesArticles', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
          
    }


   public function voirUnArticle($noArticle = NULL)
   {
      $this->form_validation->set_rules('txtQuantite', 'Quantité', 'required');
      $this->form_validation->set_rules('slctNo', 'No', 'required');

      if ($this->form_validation->run() === FALSE)
      { 
        $DonneesEnvoyees["pageActuelle"] = 'voirUnArticle/'.$noArticle.'';
        $DonneesInjectees['unArticle'] = $this->ModeleArticle->retournerArticles($noArticle);

        $DonneesInjectees['TitreDeLaPage'] = $DonneesInjectees['unArticle']['LIBELLE'];
        $this->load->view('templates/Entete');
        $this->load->view('visiteur/voirUnArticle', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
      else
      {  
        $quantite = $this->input->post('txtQuantite');
        $recuperationNoArticle = $this->input->post('slctNo');

        $DonneesEnvoyees["pageActuelle"] = 'voirUnArticle/'.$noArticle.'';
        $DonneesInjectees['unArticle'] = $this->ModeleArticle->retournerArticles($recuperationNoArticle);
        $DonneesInjectees['TitreDeLaPage'] = $DonneesInjectees['unArticle']['LIBELLE'];

        $recuperationArticle = $this->ModeleArticle->retournerArticles($recuperationNoArticle);
        $data = array(
          'id'      => $recuperationArticle['NOPRODUIT'],
          'qty'     => $quantite,
          'price'   => $recuperationArticle['PRIXHT'],
          'name'    => $recuperationArticle['LIBELLE']
          );
        $this->cart->insert($data);

        $this->load->view('templates/Entete');
        $this->load->view('visiteur/voirUnArticle', $DonneesInjectees); 
        $this->load->view('templates/PiedDePage');

      } 
  }

  public function ajouterUnArticleAuPanier($recuperationNoArticle) {
    $recuperationArticle = $this->ModeleArticle->retournerArticles($recuperationNoArticle);
    $data = array(
      'id'      => $recuperationArticle['NOPRODUIT'],
      'qty'     => 1,
      'price'   => $recuperationArticle['PRIXHT'],
      'name'    => $recuperationArticle['LIBELLE']
    );
    $this->cart->insert($data);
    redirect('visiteur/listerLesArticle');
  }

  public function afficherPanier() {
    $DonneesInjectees['lesitems'] = $this->cart->contents();
    $this->load->view('templates/Entete');
    $this->load->view('visiteur/panier', $DonneesInjectees);
    $this->load->view('templates/PiedDePage');
  }

  public function validerPanier() {
    $DateCommande = date("Y-m-d H:i:s");
    $DonneesAInserer = array(
      'NOCLIENT' => $_SESSION["NoClient"],
      'DATECOMMANDE' => $DateCommande
      );
    $this->ModeleArticle->passerCommande($DonneesAInserer);
    $NoCommande = $this->ModeleArticle->retournerDerniereCommande();
    foreach ($this->input->post() as $key => $value) {
      $produit = array(
        'rowid'      => $value['rowid'],
        'qty'     => $value['qty']
      );
      $item = $this->cart->get_item($produit['rowid']);
      $Article = $this->ModeleArticle->retournerArticles($item['id']);
      $quantiteEntier = doubleval($produit['qty']);
      if ($this->ModeleArticle->retournerSiArticleDispo($quantiteEntier, $Article['NOPRODUIT']) == TRUE){
        $LesDonneesAInserer = array(
          'NOCOMMANDE' => $NoCommande['0']['NOCOMMANDE'],
          'NOPRODUIT' => $Article['NOPRODUIT'],
          'QUANTITECOMMANDEE' => $quantiteEntier
          );
        $this->ModeleArticle->insereUneLigne($LesDonneesAInserer);
        $this->ModeleArticle->reduireQuantite($Article['NOPRODUIT'], $produit['qty']);
        $this->cart->remove($produit['rowid']);
      }
    }
   
    redirect('visiteur/afficherPanier');
  }

  public function modifierPanier() {
    foreach ($this->input->post() as $key => $value) {
      $modif = array(
        'rowid'      => $value['rowid'],
        'qty'     => $value['qty']
      );
      $this->cart->update($modif);
    }
    redirect('visiteur/afficherPanier');
  }

  public function supprimmerUnArticleDuPanier($rowid) {
    $this->cart->remove($rowid);
    redirect('visiteur/afficherPanier');
  }

  public function viderPanier() {
    $this->cart->destroy();
    redirect('visiteur/afficherPanier');
  }

    public function seConnecter()

{
   $DonneesInjectees['TitreDeLaPage'] = 'Se connecter';

   $this->form_validation->set_rules('txtEmail', 'Identifiant', 'required');
   $this->form_validation->set_rules('txtMotDePasse', 'Mot de passe', 'required');
  
   if ($this->form_validation->run() === FALSE)
   { 
     $this->load->view('templates/Entete');
     $this->load->view('visiteur/seConnecter', $DonneesInjectees);
     $this->load->view('templates/PiedDePage');
   }
   else
   {
     $Utilisateur = array(
       'EMAIL' => $this->input->post('txtEmail'),
       'MOTDEPASSE' => $this->input->post('txtMotDePasse'),
     );

     $UtilisateurRetourne = $this->ModeleUtilisateur->retournerUtilisateur($Utilisateur);
     if (!($UtilisateurRetourne == null))
     {
       $this->session->identifiant = $UtilisateurRetourne->PRENOM;
       $this->session->statut = $UtilisateurRetourne->PROFIL;
       $_SESSION["NoClient"] = $UtilisateurRetourne->NOCLIENT;

       $DonneesInjectees['Identifiant'] = $Utilisateur['EMAIL'];
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
    $this->cart->destroy();

    redirect('visiteur/afficheracceuil');
}

public function Inscription() {
  $DonneesInjectees['TitreDeLaPage'] = 'Inscription';
  if ($this->input->post('boutonAjouter'))
    {
      $donneesAInserer = array(
        'NOM' => $this->input->post('txtNom'),
        'PRENOM' => $this->input->post('txtPrenom'),
        'ADRESSE' => $this->input->post('txtAdresse'),
        'VILLE' => $this->input->post('txtVille'),
        'CODEPOSTAL' => $this->input->post('txtCodePostal'),
        'EMAIL' => $this->input->post('txtEmail'),
        'MOTDEPASSE' => $this->input->post('txtMDP'),
      );
      $this->ModeleUtilisateur->insererUnClient($pDonneesAInserer);
      $this->load->helper('url');
      $this->load->view('visiteur/inscriptionReussie');
    }
    else
    {  
      $this->load->view('templates/Entete');
      $this->load->view('visiteur/Inscription', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
  } 

public function listerLesArticlesAvecPagination() {
 $config = array();
 $config["base_url"] = site_url('visiteur/listerLesArticlesAvecPagination');
 $config["total_rows"] = $this->ModeleArticle->nombreDArticles();
 $config["per_page"] = 9; 
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

 $this->form_validation->set_rules('recherche', 'Recherche', 'required');

     if ($this->form_validation->run() === FALSE)
    {  
      $this->load->view('templates/Entete');
      $this->load->view("visiteur/listerLesArticlesAvecPagination", $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
    else
    {  
     $Recherche = array( 
       'LIBELLE' => $this->input->post('recherche')
     ); 
     redirect('visiteur/unerecherche/'.$Recherche['LIBELLE'].'');
     }

} 

public function modifierCompte()

{
  $this->form_validation->set_rules('nom', 'Nom', 'required');
  $this->form_validation->set_rules('prenom', 'Prénom', 'required');
   $this->form_validation->set_rules('adresse', 'Adresse', 'required');
   $this->form_validation->set_rules('ville', 'Ville', 'required');
   $this->form_validation->set_rules('codepostal', 'Code Postal', 'required');
   $this->form_validation->set_rules('email', 'E-Mail', 'required');
   $this->form_validation->set_rules('mdp', 'Mot de passe', 'required');

   $DonneesInjectees['TitreDeLaPage'] = 'Information de votre compte';

   if ($this->form_validation->run() === FALSE)
   { 
     $Utilisateur = $this->ModeleUtilisateur->retournerUnUtilisateur($_SESSION["NoClient"]);
    $DonneesInjectees['Infos'] = array(
      'NOM' => $Utilisateur['NOM'],
      'PRENOM' => $Utilisateur['PRENOM'],
      'ADRESSE' => $Utilisateur['ADRESSE'],
      'VILLE' => $Utilisateur['VILLE'],
      'CODEPOSTAL' => $Utilisateur['CODEPOSTAL'],
      'EMAIL' => $Utilisateur['EMAIL'],
      'MOTDEPASSE' => $Utilisateur['MOTDEPASSE']
    );
     $this->load->view('templates/Entete');
     $this->load->view('visiteur/modifierCompte', $DonneesInjectees); 
     $this->load->view('templates/PiedDePage');
   }
   else
   {  
    $modifUser = array(
      'NOM' => $this->input->post('nom'),
      'PRENOM' => $this->input->post('prenom'),
      'ADRESSE' => $this->input->post('adresse'),
      'VILLE' => $this->input->post('ville'),
      'CODEPOSTAL' => $this->input->post('codepostal'),
      'EMAIL' => $this->input->post('email'),
      'MOTDEPASSE' => $this->input->post('mdp')
    );
    $this->ModeleUtilisateur->modifierUnClient($modifUser, $_SESSION["NoClient"]);
    redirect('visiteur/modifierCompte');
   }
 } 

}