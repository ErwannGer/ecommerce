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
}