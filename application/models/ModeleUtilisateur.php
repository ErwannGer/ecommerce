<?php
class ModeleUtilisateur extends CI_Model {

public function __construct()
{
$this->load->database();
}

public function existe($pUtilisateur)
{
   $this->db->where($pUtilisateur);
   $this->db->from('tabutilisateur');
   return $this->db->count_all_results();
}

public function retournerUtilisateur($pUtilisateur)
{
   $requete = $this->db->get_where('tabutilisateur',$pUtilisateur);
   return $requete->row();
}
 
}