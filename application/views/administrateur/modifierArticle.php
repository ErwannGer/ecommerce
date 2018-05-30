<h2><?php echo $TitreDeLaPage ?></h2>
<?php
echo validation_errors();

echo form_open('administrateur/modifierLeProduit');

echo '<br>';
echo form_label('NoProduit : ','txtNoPorduit');
echo form_dropdown('txtNoPorduit', $Categories, array('required' => 'required', 'selected' => $Article['NOPRODUIT'])).'<BR>';

echo '<br>';
echo form_label('NoCatégorie :  ','txtNoCategorie');
echo form_dropdown('txtNoCategorie', $Categories, array('required' => 'required', 'selected' => $Article['NOCATEGORIE'])).'<BR>';

echo '<br>';
echo form_label('NoMarque','txtNoMarque');
echo form_dropdown('txtNoMarque', $Marques, array('required' => 'required', 'selected' => $Article['NOMARQUE'])).'<BR>';

echo '<br>';
echo form_label('Libéllé','txtLibelle');
echo form_input(array('name' => 'txtLibelle', 'value' => $Article['LIBELLE'], 'pattern' => '[a-zA-Z0-9\-_. ]*', 'required' => 'required')).'<BR>';

echo '<br>';
echo form_label('Détail','txtDetail');
echo form_input(array('name' => 'txtDetail', 'value' => $Article['DETAIL'], 'size' => '25', 'pattern' => '[a-zA-Z0-9\-,éàê?!_. ]*', 'required' => 'required')).'<BR>';

echo '<br>';
echo form_label('PrixHT','txtPrixHT'); 
echo form_input(array('name' => 'txtPrixHT', 'value' => $Article['PRIXHT'], 'pattern' => '[0-9\.]*', 'required' => 'required')).'<BR>';

echo '<br>';
echo form_label('TauxTVA','txtTauxTVA');
echo form_input(array('name' => 'txtTauxTVA', 'value' => $Article['TAUXTVA'], 'size' => '30', 'pattern' => '[0-9\.]*', 'required' => 'required')).'<BR>';

echo '<br>';
echo form_label('NomImage','txtNomImage');
echo form_input(array('name' => 'txtNomImage', 'value' => $Article['NOMIMAGE'], 'size' => '25', 'pattern' => '[a-zA-Z0-9\_-.]*', 'required' => 'required')).'<BR>';

echo '<br>';
echo form_label('Quantité','txtQuantiteEnStock');
echo form_input(array('name' => 'txtQuantiteEnStock', 'value' => $Article['QUANTITEENSTOCK'], 'size' => '30', 'pattern' => '[0-9\.]*', 'required' => 'required')).'<BR>';

echo '<br>';
echo form_label('Disponible','txtDisponible'); 
echo form_input(array('name' => 'txtDisponible', 'value' => $Article['DISPONIBLE'], 'size' => '30', 'pattern' => '[0-9\.]*', 'required' => 'required')).'<BR>';

echo '<br>';
echo form_submit('submit', 'Appliquer');
echo form_close();

?>