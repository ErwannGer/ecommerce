<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Exemple extends CI_Controller {

	public function index(){
		//Définition des variables et leur contenue
		$data['lambda'] = "Voici le contenu de la variable lambda";
		$data['users'] = array(
			'1' => array(
				'id' => 1,
				'login' => 'Test',
				'password' => 12345678,
				'role' => 'ROLE_USER'
		));
		//On rend la vu au fichier list_users.twig située dans application/view/ et on lui injecte le tableau $data
		$this->twig->display('list_users.twig',$data);
	}
}
 ?>
