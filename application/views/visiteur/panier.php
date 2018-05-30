<?php echo form_open('visiteur/modifierPanier'); ?>
<div>
<table class="table table-striped">
<tr>
        <th>Quantité</th>
        <th></th>
        <th>Article</th>
        <th style="text-align:right">Prix</th>
        <th style="text-align:right">Total</th>
</tr>
<?php $i = 1;
?>
<?php foreach ($lesitems as $items): ?>
        <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
        <tr>
                <td><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5', 'pattern' => '[0-9]*', 'required' => 'required')); ?></td>
                <td>
                <?php
                echo '<a href="'.site_url('visiteur/supprimmerArticlePanier/'.$items['rowid'].'').'"><button type="button" class="btn btn-danger">Effacer</button></a>';
                ?>
                </td>
                <td>
                        <?php echo '<a href="'.site_url('visiteur/voirUnArticle/'.$items['id']).'">'.$items['name'].'</a>';
                        ?>
                </td>
                <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                <td style="text-align:right"><?php echo $this->cart->format_number($items['subtotal']); ?>€</td>
        </tr>
<?php $i++; ?>

<?php endforeach; ?>
<tr>
        <td colspan="3"> </td>
        <td class="right"><strong>Total</strong></td>
        <td class="right"><?php echo $this->cart->format_number($this->cart->total()); ?>€</td>
</tr>
<a href="viderPanier">Vider Panier</a>
</table>
<p><?php echo form_submit('', 'Modifier le panier');
echo form_close();
?></p>

<?php
$i = 1;
if (!is_null($this->session->identifiant)) :
echo form_open('visiteur/validerPanier');
foreach ($lesitems as $items): ?>
        <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
        <?php echo form_hidden($i.'[qty]', $items['qty']); ?>
<?php $i++; ?>

<?php endforeach;
echo form_submit('', 'Valider');
echo form_close();
endif;
?>
<br>
</div>
