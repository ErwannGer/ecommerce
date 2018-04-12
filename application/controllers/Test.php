<?php
class Test extends CI_Controller
{

public function bonjourSimple()
{
$this->load->view('test/bonjourSimple'); // appel de la vue... pas d'affichage dans le controleur
}
}
