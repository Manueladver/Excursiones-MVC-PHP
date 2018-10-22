<?php ob_start() ?>

<h1>VER ALUMNOS</h1>

<table>
	<tr>
		<th>Nick</th>
		<th>Password</th>
		<th>Nombre completo</th>
	</tr>

	<?php foreach ($params['alumnos'] as $alumno): ?>

	<tr>
		<td><?php echo $alumno['nick'] ?></td>
		<td><?php echo $alumno['password']?></td>
		<td><?php echo $alumno['nombreCompleto']?></td>
	</tr>

	<?php endforeach; ?>

</table>

<form name="formOrden" action="index.php?action=verAlumnos" method="POST">
	<label for="orden">Ordenar por 
		<select name="val">
			<option value="nick">Nick</option>
			<option value="password">Password</option>
		</select>
		en sentido
		<select name="tipo">
			<option value="ASC">Ascendente</option>
			<option value="DESC">Descendente</option>
		</select>
	</label>

	<input type="submit" value="Ordenar" />
</form>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>