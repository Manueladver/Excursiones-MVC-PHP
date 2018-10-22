<?php ob_start() ?>

<h1>> EXCURSIONES DISPONIBLES</h1>

<?php foreach ($noExcursiones['noExcursiones'] as $excursion): ?>
<form name="formApuntarse" action="index.php?action=apuntarse" method="POST">
	<p style="text-decoration: underline;"><strong><?php echo $excursion['titulo']?></strong></p>
	<input type="hidden" name="titulo" value="<?php echo $excursion['titulo']?>">
	<p style="text-decoration: underline;">Fecha: <?php echo $excursion['fecha']?></p>
	<p style="text-decoration: underline;">Descripción: <?php echo $excursion['descripcion']?></p>
	<input type="submit" value="Me apunto" name="apuntarse"/>
</form>

<br>

<?php endforeach; ?>

<br>

<h1>> EXCURSIONES EN LAS QUE ESTAS APUNTADO</h1>

<?php foreach ($excursiones['excursiones'] as $excursion): ?>

<p style="text-decoration: underline;"><strong><?php echo $excursion['titulo']?></strong></p>
<p style="text-decoration: underline;">Fecha: <?php echo $excursion['fecha']?></p>
<p style="text-decoration: underline;">Descripción: <?php echo $excursion['descripcion']?></p>

<br>

<?php endforeach; ?>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>