<?php 

public function insererUnProduit($pDonneesAInserer)

{

    return $this->db->insert('noProduit', $pDonneesAInserer);

} // insererUnProduit