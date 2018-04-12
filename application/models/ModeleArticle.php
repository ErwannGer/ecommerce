<?php
class ModeleArticle extends CI_Model {

public function __construct()
{
$this->load->database();
}

     public function retournerArticles($pNoArticle = FALSE)
     {
        if ($pNoArticle === FALSE)
        {
             $requete = $this->db->get('tabarticle');
             return $requete->result_array();
        }
        $requete = $this->db->get_where('tabarticle', array('cNo' => $pNoArticle));
        return $requete->row_array();
     }



public function insererUnArticle($pDonneesAInserer)
{
    return $this->db->insert('tabarticle', $pDonneesAInserer);
}

public function retournerArticlesLimite($nombreDeLignesARetourner, $noPremiereLigneARetourner)
{
$this->db->limit($nombreDeLignesARetourner, $noPremiereLigneARetourner);
$requete = $this->db->get("tabarticle");

if ($requete->num_rows() > 0) {
foreach ($requete->result() as $ligne) {
$jeuDEnregsitrements[] = $ligne;
}
return $jeuDEnregsitrements;
}
return false;
}

public function nombreDArticles() {
return $this->db->count_all("tabarticle");
}
}
