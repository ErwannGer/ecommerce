<?php
class ModeleArticle extends CI_Model {
    public function insererUnArticle($pDonneesAInserer)
    {
      return $this->db->insert('produit', $pDonneesAInserer);
    }
}