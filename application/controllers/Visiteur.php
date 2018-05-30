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
           $DonneesEnvoyees["lesCategories"] = $this->ModeleArticle->retournerCategories();
     
           $this->load->view('templates/Entete', $DonneesEnvoyees);
           $this->load->view('visiteur/accueil', $DonneesInjectees);
           $this->load->view('templates/PiedDePage');
               
         } 

        public function listerLesArticlesPage()
        {
            $config = array();
      $config["base_url"] = site_url('visiteur/listerLesArticlesPage');
      $config["total_rows"] = $this->ModeleArticle->nombreDArticles();
      $config["per_page"] = 9; 
      $config["uri_segment"] = 3;
    
      $config['first_link'] = 'Premier';    
      $config['last_link'] = 'Dernier';
      $config['next_link'] = 'Suivant';
      $config['prev_link'] = 'Précédent';
    
      $this->pagination->initialize($config);
      $noPage = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
      $DonneesEnvoyees["lesCategories"] = $this->ModeleArticle->retournerCategories();
      $DonneesInjectees['TitreDeLaPage'] = 'Les articles, avec pagination';
      $DonneesInjectees["lesArticles"] = $this->ModeleArticle->retournerArticlesLimite($config["per_page"], $noPage);
      $DonneesInjectees["liensPagination"] = $this->pagination->create_links();
    
    }
 
        
          public function listerLesArticlesParCategorie($noCategorie = NULL) {
            $config = array();
            $config["base_url"] = site_url('visiteur/listerLesArticlesParCategorie');
            $config["total_rows"] = $this->ModeleArticle->nombreDArticlesParCategorie($noCategorie);
            $config["per_page"] = 9;  
            $config["uri_segment"] = 3; 
            $config['first_link'] = 'Premier';
            $config['last_link'] = 'Dernier';
            $config['next_link'] = 'Suivant';
            $config['prev_link'] = 'Précédent';
          
            $this->pagination->initialize($config);
          
            $noPage = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
            $DonneesEnvoyees["lesCategories"] = $this->ModeleArticle->retournerCategories();
          
            $DonneesInjectees['TitreDeLaPage'] = $this->ModeleArticle->retournerCategories($noCategorie);
            $DonneesInjectees["lesArticles"] = $this->ModeleArticle->retournerArticlesParCategorie($config["per_page"], $noPage, $noCategorie);
            $DonneesInjectees["liensPagination"] = $this->pagination->create_links();
            
                 $this->load->view('templates/Entete', $DonneesEnvoyees);
                $this->load->view("visiteur/listerLesArticlesPage", $DonneesInjectees);
                $this->load->view('templates/PiedDePage');
          
          } 

        public function seConnecter()
        {
          $this->load->helper('form');
          $this->load->library('form_validation');
       
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
                $this->load->library('session');
                $this->session->identifiant = $UtilisateurRetourne->PRENOM;
            
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

        public function voirUnArticle($noArticle = NULL)
        {
            $this->form_validation->set_rules('txtQuantite', 'Quantité', 'required');
            $this->form_validation->set_rules('slctNo', 'No', 'required');
            $DonneesEnvoyees["lesCategories"] = $this->ModeleArticle->retournerCategories();
      
            if ($this->form_validation->run() === FALSE)
            { 
              $DonneesEnvoyees["pageActuelle"] = 'voirUnArticle/'.$noArticle.'';
              $DonneesInjectees['unArticle'] = $this->ModeleArticle->retournerArticles($noArticle);
      
              $DonneesInjectees['TitreDeLaPage'] = $DonneesInjectees['unArticle']['LIBELLE'];
              $this->load->view('templates/Entete', $DonneesEnvoyees);
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
      
              $this->load->view('templates/Entete', $DonneesEnvoyees);
              $this->load->view('visiteur/voirUnArticle', $DonneesInjectees); 
              $this->load->view('templates/PiedDePage');
      
            } 
        }

        public function seDeConnecter() {
            $this->session->sess_destroy();
       
        $this->load->view('visiteur/seDeconnecter');
        }

        public function creerUnCompte()
        {
            $this->load->helper('form');
            $DonneesInjectees['TitreDeLaPage'] = 'Créer un compte';
 
            if ($this->input->post('boutonAjouter'))
            {
                $donneesAInserer = array(
                    'NOM' => $this->input->post('txtNom '),
                    'PRENOM' => $this->input->post('txtPrenom'),
                    'ADRESSE' => $this->input->post('txtAdresse'),
                    'VILLE' => $this->input->post('txtVille'),
                    'CODEPOSTAL' => $this->input->post('txtCodePostal'),
                    'EMAIL' => $this->input->post('txtAmail'),
                    'MOTDEPASSE' => $this->input->post('txtMotDePasse'),
                );
                $this->ModeleClient->insererUnClient($donneesAInserer);
                $this->load->helper('url');
                $this->load->view('visiteur/creationReussie');
                  
            }
        }

        public function accueil()
        {
            $DerniereDate = $this->ModeleArticle->retournerDerniereDate();
            $DonneesInjectees['unArticle'] = $this->ModeleArticle->retournerDernierArticle($DerniereDate['MAX(DATEAJOUT)']);
            $DonneesInjectees['TitreDeLaPage'] = 'Acceuil';
            $DonneesEnvoyees["lesCategories"] = $this->ModeleArticle->retournerCategories();

            $this->load->view('templates/Entete', $DonneesEnvoyees);
            $this->load->view('visiteur/accueil', $DonneesInjectees);
            $this->load->view('templates/PiedDePage');
        } 

        public function afficherPanier() {
            $DonneesEnvoyees["lesCategories"] = $this->ModeleArticle->retournerCategories();
            $DonneesInjectees['lesitems'] = $this->cart->contents();
            $this->load->view('templates/Entete', $DonneesEnvoyees);
            $this->load->view('visiteur/panier', $DonneesInjectees);
            $this->load->view('templates/PiedDePage');
          }
     
          public function ajouterArticlePanier($recuperationNoArticle) {
            $recuperationArticle = $this->ModeleArticle->retournerArticles($recuperationNoArticle);
            $data = array(
              'id'      => $recuperationArticle['NOPRODUIT'],
              'qty'     => 1,
              'price'   => $recuperationArticle['PRIXHT'],
              'name'    => $recuperationArticle['LIBELLE']
            );
            $this->cart->insert($data);
            redirect('visiteur/listerLesArticlesPage');
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

          public function supprimmerArticlePanier($rowid) {
            $this->cart->remove($rowid);
            redirect('visiteur/afficherPanier');
          }

          public function viderPanier() {
            $this->cart->destroy();
            redirect('visiteur/afficherPanier');
          }        
}