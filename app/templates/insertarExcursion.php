<?php ob_start() ?>

<h1>NUEVA EXCURSIÓN</h1>

<form name="formInsertar" action="index.php?action=nuevaExcursion" method="POST">
	<label for="titulo">Título</label>
	<input type="text" name="titulo" id="titulo" value="" />

	<label for="fecha">Fecha</label>
	<input type="date" name="fecha" id="fecha" value="" />

	<label for="descripcion">Descripción</label>
	<textarea name="descripcion" id="descripcion" value="" rows="5" cols="50"/></textarea>

	<input type="submit" value="Añadir excursión" name="insertar" />
</form>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?> 