<?php
class ModeleArticle extends CI_Model {
  public function __construct()
  
  {
    $this->load->database();
  }
    public function insererUnArticle($pDonneesAInserer)
    {
      return $this->db->insert('produit', $pDonneesAInserer);
    }
  
     
      public function retournerArticles($pNoProduit = FALSE)
      {
        if ($pNoProduit === FALSE)
        {
          $requete = $this->db->get('produit');
          return $requete->result_array();
        }
          $requete = $this->db->get_where('produit', array('NOPRODUIT' => $pNoProduit));
          return $requete->row_array();
      }
      public function retournerDernierArticle($pDerniereDate)
     {
       $requete =$this->db->query("SELECT * FROM produit where DATEAJOUT = '".$pDerniereDate."'");
       return $requete->row_array();
     }
     public function retournerDerniereDate()
     {
       $requete =$this->db->query("SELECT MAX(DATEAJOUT) FROM produit");
       foreach ($requete->result_array() as $ligne){
         $jeuDEnregistrements = $ligne;
       }
       return $jeuDEnregistrements;
     }
    }
