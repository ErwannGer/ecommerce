<?php
class ModeleArticle extends CI_Controller {
  public function insererUnArticle($pDonneesAInserer)
        {
            return $this->db->insert('tabarticle', $pDonneesAInserer);
        }
}