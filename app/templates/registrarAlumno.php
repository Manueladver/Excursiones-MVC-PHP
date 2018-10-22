<?php ob_start() ?>

<h1>REGISTRAR ALUMNO</h1>

<form name="formInsertar" action="index.php?action=registrarAlumno" method="POST">
	<label for="nick">Nick</label>
	<input type="text" name="nick" id="nick" value="" />

	<label for="password">Password</label>
	<input type="password" name="password" id="password" value="" />

	<label for="nombreCompleto">Nombre completo</label>
	<input type="text" name="nombreCompleto" id="nombreCompleto" value="" />

	<input type="submit" value="Registrar alumno" name="insertar" />
</form>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?> 