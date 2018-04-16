    public function insererUnArticle($pDonneesAInserer)
        {
            return $this->db->insert('tabarticle', $pDonneesAInserer);
        }