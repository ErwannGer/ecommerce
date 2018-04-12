<?php

class Visiteur extends CI_Controller {
   public function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('assets'); // helper 'assets' ajouté a Application
      $this->load->library("pagination");
      $this->load->model('ModeleUtilisateur');
   }
   public function seConnecter()
{
   $this->load->helper('form');
   $this->load->library('form_validation');
   $DonneesInjectees['TitreDeLaPage'] = 'Se connecter';
   $this->form_validation->set_rules('txtIdentifiant', 'Identifiant', 'required');
   $this->form_validation->set_rules('txtMotDePasse', 'Mot de passe', 'required');
   // Les champs txtIdentifiant et txtMotDePasse sont requis
   // Si txtMotDePasse non renseigné envoi de la chaine 'Mot de passe' requis
   if ($this->form_validation->run() === FALSE)
   {  // échec de la validation
// cas pour le premier appel de la méthode : formulaire non encore appelé
$this->load->view('seConnecter', $DonneesInjectees); // on renvoie le formulaire
   }
   else
   {  // formulaire validé
$Utilisateur = array( // cIdentifiant, cMotDePasse : champs de la table tabutilisateur
   'matricule' => $this->input->post('txtIdentifiant'),
   'Password' => md5($this->input->post('txtMotDePasse')),
); // on récupère les données du formulaire de connexion
// on va chercher l'utilisateur correspondant aux Id et MdPasse saisis
$UtilisateurRetourne = $this->ModeleUtilisateur->retournerUtilisateur($Utilisateur);
if (!($UtilisateurRetourne == null))

{    // on a trouvé, identifiant et statut (droit) sont stockés en session

     $this->load->library('session');

     $this->session->identifiant = $UtilisateurRetourne->matricule;

     $this->session->statut = $UtilisateurRetourne->matricule;
     $DonneesInjectees['Identifiant'] = $Utilisateur['matricule'];
  $this->load->view('connexionReussie', $DonneesInjectees);
}
else
{    // utilisateur non trouvé on renvoie le formulaire de connexion
     $this->load->view('seConnecter', $DonneesInjectees);
}
}
} // fin seConnecter

   }
