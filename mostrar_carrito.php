<?php
include('global/config.php');
include('carrito.php');
include('templates/cabecera.php');
?>

<br>
<h3>Lista del carrito</h3>

<!-- b-table -->
<table class="table table-light table-bordered">
    <tbody>
        <tr>
            <th width="40%">Descripción</th>
            <th width="15%">Cantidad</th>
            <th width="20%">Precio</th>
            <th width="20%">Total</th>
            <th width= "5%">--</th>
        </tr>
        <tr>
            <th width="40%">Libro PHP</th>
            <th width="15%" class="text-center">1</th>
            <th width="20%" class="text-center">$300</th>
            <th width="20%" class="text-center">$200</th>
            <th width= "5%"><button class="btn btn-danger" type="button">Eliminar</button></th>
        </tr>
        <tr>
            <td colspan="3" align="right"><h3>Total</h3></td>
            <td align="right"><h3><?php echo number_format(300, 2); ?></h3></td>
            <td></td>
        </tr>
    </tbody>
</table>

<?php include('templates/pie.php'); ?>