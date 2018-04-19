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
  
     
      public function retournerArticles($pNoArticle = FALSE)
      {
        if ($pNoArticle === FALSE)
        {
          $requete = $this->db->get('produit');
          return $requete->result_array();
        }
          $requete = $this->db->get_where('produit', array('NOPRODUIT' => $pNoArticle));
          return $requete->row_array();
      }
    }
