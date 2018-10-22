

<!DOCTYPE html>

	<html lang="es">

		<head>
			<meta charset="utf-8">
			<title>Desarrollo web en entorno servidor - tema 10 - MVC</title>
			<link rel="stylesheet" href="<?php echo'css/'.Config::$mvc_vis_css ?>"/>
		</head>

		<body>

			<header>
				<h1>Aplicación de Excursiones</h1>
			</header>

			<nav>
				<ul>
					<?php if(!isset($_SESSION['usuario'])) {
						echo '<li><a href="index.php?action=inicio">Inicio</a></li>';
						}
					?>
					<?php if(isset($_SESSION['usuario']) && $_SESSION['esProfesor'] == 1) {
							echo '<li><a href="index.php?action=verExcursiones">Inicio</a></li>';
							echo '<li><a href="index.php?action=nuevaExcursion">Nueva excursión</a></li>';
							echo '<li><a href="index.php?action=borrarExcursion">Borrar excursión</a></li>';
							echo '<li><a href="index.php?action=registrarAlumno">Registrar alumno</a></li>';
							echo '<li><a href="index.php?action=borrarAlumno">Borrar alumno</a></li>';
							echo '<li><a href="index.php?action=verAlumnos">Ver alumnos</a></li>';
							echo '<li><a href="index.php?action=verExcursiones">Ver excursiones</a></li>';
						}
					?>
					<?php if(isset($_SESSION['usuario']) && $_SESSION['esProfesor'] == 0) {
							echo '<li><a href="index.php?action=apuntarse">Inicio</a></li>';
							echo '<li><a href="index.php?action=apuntarse">Apuntarse</a></li>';
						}
					?>
				</ul>
			</nav>
			
			<main>
				<?php echo $contenido ?>
			</main>

			<footer id="pie">
				<p>- DWES -</p>
				<?php if(isset($_SESSION['usuario'])) {
						echo '<p>¡Bienvenido, <strong>'.$_SESSION['usuario'].'!</strong> (<a href="index.php?action=logout">logout</a>)</p>';
					}
				?>
			</footer>

		</body>

	</html>