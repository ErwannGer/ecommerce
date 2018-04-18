//<?php
//class Visiteur extends CI_Controller {
   // public function index()
       // $this->load->view('templates/index');
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
       }