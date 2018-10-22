<?php ob_start() ?>

<h1><?php echo $titulo ?></h1>

<p style="text-decoration: underline;">Alumnos apuntados</p>

<?php 

	if($params['alumnos'] == null) {
		echo '<p>Todavía no se ha apuntado ningún alumno</p>';
	}

?>

<ul>
	<?php foreach ($params['alumnos'] as $alumno): ?>
	<li><?php echo $alumno['nickUsuario'] ?> <a href="index.php?action=eliminar&titulo=<?php echo $titulo?>&nickUsuario=<?php echo $alumno['nickUsuario']?>"><img src="../web/images/close.png" style="width: 20px; height: 20px;"></a></li>
	<?php endforeach; ?>
<ul>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?> 