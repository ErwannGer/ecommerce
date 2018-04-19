<?php
class ModeleArticle extends CI_Model {
    public function insererUnArticle($DonneesAInserer)
    {
      return $this->db->insert('produit', $DonneesAInserer);
    }
}