<?php ob_start() ?>

<h1>Ver Excursiones</h1>

<table>
	<tr>
		<th>Título</th>
		<th>Fecha</th>
		<th>Descripción</th>
	</tr>

	<?php foreach ($params['excursiones'] as $excursion): ?>

	<tr>
		<td><a href="index.php?action=ver&titulo=<?php echo $excursion['titulo']?>"><?php echo $excursion['titulo'] ?></a></td>
		<td><?php echo $excursion['fecha']?></td>
		<td><?php echo $excursion['descripcion']?></td>
	</tr>

	<?php endforeach; ?>

</table>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>