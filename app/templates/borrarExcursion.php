<?php ob_start() ?>

<h1>BORRAR EXCURSIÓN</h1>

<form name="formEliminar" action="index.php?action=borrarExcursion" method="POST">
	<label for="titulo">Título exacto de la excursión</label>
	<input type="text" name="titulo" id="titulo" value="" />

	<input type="submit" value="Eliminar excursión" />
</form>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?> 