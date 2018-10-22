<?php

	//Definimos la clase Controller
	class Controller {

		//Función inicio
		public function inicio() {

			$params = array(
				'usuario' => '',
				'contrasena' => ''
			);

			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				//Comprobamos si el usuario esta en la base de datos
				$check = $m->checkUsuario($_POST['usuario'], $_POST['contrasena']);

				//Si el usuario existe
				if($check == true) {

					$_SESSION['usuario'] = $_POST['usuario'];

					// Comprobamos si tiene permisos
					$tipo = $m->checkPermisos($_POST['usuario']);
					$_SESSION['esProfesor'] = $tipo;

					if($tipo == 1) {

						header('Location: index.php?action=verExcursiones');

					} else {

						header('Location: index.php?action=apuntarse');

					}

				} else {

					//Mensaje de error si no existe el usuario o la contraseña es inválida
					$params['mensaje'] = 'Usuario o contraseña inválido';

				}

			}

			require __DIR__ . '/templates/inicio.php';

		}

		//Función para insertar excursiones
		public function nuevaExcursion() {

			$params = array(
				'titulo' => '',
				'fecha' => '',
				'descripcion' => ''
			);

			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$m->insertarExcursion(
					$_POST['titulo'], 
					$_POST['fecha'],
					$_POST['descripcion']
				);

				header('Location: index.php?action=verExcursiones');

			}

			require __DIR__ .'/templates/nuevaExcursion.php';

		}

		//Función para eliminar excursiones
		public function borrarExcursion() {

			$params = array(
				'titulo' => '',
				'resultado' => array()
			);

			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

			if($_SERVER['REQUEST_METHOD'] == 'POST') {

				$params['titulo'] = $_POST['titulo'];
				$params['resultado'] = $m->eliminarExcursion(
					$_POST['titulo']
				);

				header('Location: index.php?action=verExcursiones');

			}

			require __DIR__ .'/templates/borrarExcursion.php';

		}

		//Función para dar de alta alumnos
		public function registrarAlumno() {

			$params = array(
				'nick' => '',
				'password' => '',
				'nombreCompleto' => ''
			);

			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$m->insertarAlumno(
					$_POST['nick'], 
					$_POST['password'],
					$_POST['nombreCompleto']
				);

				header('Location: index.php?action=verAlumnos');

			}

			require __DIR__ .'/templates/registrarAlumno.php';

		}

		//Función para eliminar alumnos
		public function borrarAlumno() {

			$params = array(
				'nick' => '',
				'resultado' => array()
			);

			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

			if($_SERVER['REQUEST_METHOD'] == 'POST') {

				$params['nick'] = $_POST['nick'];
				$params['resultado'] = $m->eliminarAlumno(
					$_POST['nick']
				);

				header('Location: index.php?action=verAlumnos');

			}

			require __DIR__ .'/templates/borrarAlumno.php';

		}

		//Función para listar alumnos
		public function verAlumnos() {

			$params = array(
				'val' => '',
				'tipo' =>'',
				'alumnos' => array()
			);

			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
			$params = array('alumnos' => $m->verAlumnos());

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$params['val'] = $_POST['val'];
				$params['tipo'] = $_POST['tipo'];
				$params['alumnos'] = $m->ordenarPor(
					$_POST['val'],
					$_POST['tipo']
				);

			}

			require __DIR__ .'/templates/verAlumnos.php';

		} 

		//Función ver el listado de excursiones
		public function verExcursiones() {

			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
			$params = array('excursiones' => $m->listarExcursiones());

			require __DIR__ .'/templates/verExcursiones.php';

		}

		//Función para ver los alumnos en una excursión
		public function ver() {

			if (!isset($_GET['titulo'])) {

				throw new Exception('Página no encontrada');
			}

			$titulo = $_GET['titulo'];

			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
			
			$params = array(
				'alumnos' => array()
			);

			$params['alumnos'] = $m->verExcursion(
				$titulo
			);

			require __DIR__ . '/templates/verExcursion.php';

		}

		//Función para ver las excursiones en las que el alumno esta apuntado y a cuales se puede apuntar
		public function apuntarse() {

			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

			$noExcursiones = array('noExcursiones' => $m->excursionesNoApuntado(
				$_SESSION['usuario']
			));

			$params = array(
				'nickUsuario' => '',
				'titulo' => ''
			);

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$m->apuntarAlumno(
					$_SESSION['usuario'],
					$_POST['titulo']
				);

				header('Location: index.php?action=apuntarse');

			}

			$excursiones = array('excursiones' => $m->excursionesApuntado(
				$_SESSION['usuario']
			));

			require __DIR__ . '/templates/apuntarse.php';

		}

		//Función para eliminar a un alumno de una excursión
		public function eliminar() {

			if (!isset($_GET['titulo']) && !isset($_GET['nickUsuario'])) {

				throw new Exception('Página no encontrada');

			}

			$titulo = $_GET['titulo'];
			$nickUsuario = $_GET['nickUsuario'];

			$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

			$m->desapuntarAlumno(
				$titulo,
				$nickUsuario
			);

			header("Location: index.php?action=ver&titulo=$titulo");

		}

		//Función para cerrar sesión
		public function logout() {

			if(isset($_SESSION['usuario'])) {
		
				$_SESSION = array();
				session_destroy();
		
			}
	
			header("Location: index.php?action=inicio");

		}

	}

?>