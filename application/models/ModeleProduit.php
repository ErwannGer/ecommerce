<?php

class ModeleProduit extends CI_Model {

 

public function __construct()

{

$this->load->database();

/* chargement database.php (dans config), obligatoirement dans le constructeur */

}

 

     public function retournerProduit($pNoProduit = FALSE)

     {

        if ($pNoProduit === FALSE) // pas de n° d'article en paramètre

        {  // on retourne tous les articles

             $requete = $this->db->get('noproduit');

             return $requete->result_array(); // retour d'un tableau associatif

        }

        // ici on va chercher l'article dont l'id est $pNoArticle

        $requete = $this->db->get_where('noproduit', array('cNo' => $pNoProduit));

        return $requete->row_array(); // retour d'un tableau associatif

     } // fin retournerArticles

 

} // Fin Classe

public function retournerProduitsLimite($nombreDeLignesARetourner, $noPremiereLigneARetourner)

{// Nota Bene : surcharge non supportée par PHP

$this->db->limit($nombreDeLignesARetourner, $noPremiereLigneARetourner);

$requete = $this->db->get("noProduit");

 

if ($requete->num_rows() > 0) { // si nombre de lignes > 0

foreach ($requete->result() as $ligne) {

$jeuDEnregsitrements[] = $ligne;

}

return $jeuDEnregsitrements;

} // fin if

return false;

} // retournerProduitsLimite

public function nombreDProduit() { // méthode utilisée pour la pagination

    return $this->db->count_all("noProduit");
    
    } // nombreDProduits
    
  