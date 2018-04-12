<?php
  class ModeleTest extends CI_Model
  {
    public function __construct()
    {
      $this->load->database();
    }
    public function insertion($pDonneesAInserer)
    {
      return $this->db->insert('formation',$pDonneesAInserer);
    }
    public function retournerFormations($pNoFormation = FALSE)
    {
       if ($pNoFormation === FALSE)
       {
            $requete = $this->db->get('formation');
            return $requete->result_array();
       }
       $requete = $this->db->get_where('formation', array('idformation' => $pNoFormation));
       return $requete->row_array();
    }
    public function retournerFormationsLimite($nombreDeLignesARetourner, $noPremiereLigneARetourner)
    {
      $this->db->limit($nombreDeLignesARetourner, $noPremiereLigneARetourner);
      $requete = $this->db->get("formation");
      if ($requete->num_rows() > 0) {
      foreach ($requete->result() as $ligne) {
      $jeuDEnregsitrements[] = $ligne;
    }
    return $jeuDEnregsitrements;
    }
    return false;
      }
      public function nombreFormation() { // méthode utilisée pour la pagination
        return $this->db->count_all("formation");

  }
  }
 ?>
