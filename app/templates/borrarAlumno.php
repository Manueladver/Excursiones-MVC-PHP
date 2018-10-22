<?php ob_start() ?>

<h1>BORRAR ALUMNO</h1>

<form name="formEliminar" action="index.php?action=borrarAlumno" method="POST">
	<label for="nick">Nick exacto del alumno</label>
	<input type="text" name="nick" id="nick" value="" />

	<input type="submit" value="Eliminar alumno" />
</form>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?> 