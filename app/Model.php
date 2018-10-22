<?php

	// Definimos la clase Model

	class Model {

		protected $conexion;

		// Conexión a la base de datos
		public function __construct($dbname, $dbuser, $dbpass, $dbhost) {

			$mvc_bd_conexion = new mysqli($dbhost, $dbuser, $dbpass);
			$error = $mvc_bd_conexion->connect_errno;

			if ($error != null) {

				die('No ha sido posible realizar la conexión con la base de datos: '.$mvc_bd_conexion->connect_error);

			}

			$mvc_bd_conexion->select_db($dbname);
			$mvc_bd_conexion->set_charset('utf8');
			$this->conexion = $mvc_bd_conexion;

		}

		///////////////////////////////////// FUNCIONES PRIVADAS /////////////////////////////////////

		//Función para comprobar si el usurio existe
		private function checkUsuarioDB($sql) {

			$result = $this->conexion->query($sql);

			$check = $result->fetch_row();

			if($check != null) {

				return true;

			} else {

				return false;

			}
		}

		//Función para ver el tipo de usuario
		private function checkPermisosDB($sql) {

			$result = $this->conexion->query($sql);

			$check = $result->fetch_row();

			return $check[0];
		}

		//Función para sacar los usuarios que tenemos en la base de datos
		private function verAlumnosDB($sql) {

			$result = $this->conexion->query($sql);

			$alumnos = array();

			while ($row = $result->fetch_assoc()) {

				$alumnos[] = $row;

			}

			return $alumnos;
		}

		//Función para sacar las excursiones que tenemos en la base de datos
		private function listarExcursionesDB($sql) {

			$result = $this->conexion->query($sql);

			$excursiones = array();

			while ($row = $result->fetch_assoc()) {

				$excursiones[] = $row;

			}

			return $excursiones;
		}

		//Función borrar
		private function eliminando($sql) {

			$result = $this->conexion->query($sql);

		}

		///////////////////////////////////// FUNCIONES PÚBLICAS /////////////////////////////////////

		//Comprobar usuario
		public function checkUsuario($usuario, $contrasena) {

			$usuario = htmlspecialchars($usuario);
			$contrasena = htmlspecialchars($contrasena);

			$sql = "SELECT nick FROM usuarios WHERE nick='".$usuario."' AND password='".$contrasena."'";

			return $this->checkUsuarioDB($sql);

		}

		//Comprobar permisos usuario
		public function checkPermisos($usuario) {

			$usuario = htmlspecialchars($usuario);
			$sql = "SELECT esProfesor FROM usuarios WHERE nick='".$usuario."'";

			return $this->checkPermisosDB($sql);

		}

		//Función para añadir excursiones
		public function insertarExcursion($titulo, $fecha, $descripcion) {

			$titulo = htmlspecialchars($titulo);
			$fecha = htmlspecialchars($fecha);
			$descripcion = htmlspecialchars($descripcion);

			$sql = "INSERT INTO excursiones (titulo, fecha, descripcion) VALUES ('".$titulo."','".$fecha."','".$descripcion."')";
			$result = $this->conexion->query($sql);

			return $result;

		}

		//Función para eliminar alimento
		public function eliminarExcursion($titulo) {

			$titulo = htmlspecialchars($titulo);

			$sql = "DELETE FROM excursiones WHERE titulo='".$titulo."'";

			return $this->eliminando($sql);

		}

		//Función para dar de alta alumnos
		public function insertarAlumno($nick, $password, $nombreCompleto) {

			$nick = htmlspecialchars($nick);
			$password = htmlspecialchars($password);
			$nombreCompleto = htmlspecialchars($nombreCompleto);

			$sql = "INSERT INTO usuarios (nick, password, nombreCompleto) VALUES ('".$nick."','".$password."','".$nombreCompleto."')";
			$result = $this->conexion->query($sql);

		}

		//Función para eliminar alumnos
		public function eliminarAlumno($nick) {

			$nick = htmlspecialchars($nick);

			$sql = "DELETE FROM usuarios WHERE nick='".$nick."'";

			return $this->eliminando($sql);

		}

		//Función para listar todos los alumnos
		public function verAlumnos() {

			$sql = "SELECT * FROM usuarios WHERE esProfesor=0 ORDER BY nombreCompleto ASC";

			return $this->verAlumnosDB($sql);
		}

		//Función para ordernar los alimentos
		public function ordenarPor($val, $tipo) {

			$val =  htmlspecialchars($val);
			$tipo =  htmlspecialchars($tipo);

			$sql = "SELECT * FROM usuarios WHERE esProfesor=0 ORDER BY $val $tipo";

			return $this->verAlumnosDB($sql);

		}

		//Función con la consulta para sacar todas las excursiones
		public function listarExcursiones() {

			$sql = "SELECT * FROM excursiones ORDER BY fecha ASC";

			return $this->listarExcursionesDB($sql);
		}

		//Función sacar alumnos apuntados a una excursión
		public function verExcursion($titulo) {

			$titulo = htmlspecialchars($titulo);

			$sql = "SELECT nickUsuario FROM apuntados WHERE tituloExcursion='".$titulo."'";

			return $this->verAlumnosDB($sql);

		}

		//Función para ver el listado de excursiones en las que no esta apuntado
		public function excursionesNoApuntado($usuario) {

			$usuario = htmlspecialchars($usuario);

			$sql = "SELECT * FROM excursiones WHERE titulo NOT IN (SELECT tituloExcursion FROM apuntados WHERE nickUsuario='".$usuario."')";

			return $this->listarExcursionesDB($sql);

		}

		//Función para que un alumno se apunte a una excursión
		public function apuntarAlumno($usuario, $titulo) {

			$usuario = htmlspecialchars($usuario);
			$titulo = htmlspecialchars($titulo);

			$sql = "INSERT INTO apuntados (id, nickUsuario, tituloExcursion) VALUES (DEFAULT,'".$usuario."','".$titulo."')";
			$result = $this->conexion->query($sql);

		}

		//Función para ver el listado de excursiones de un alumno
		public function excursionesApuntado($usuario) {

			$usuario = htmlspecialchars($usuario);

			$sql = "SELECT * FROM excursiones WHERE titulo IN (SELECT tituloExcursion FROM apuntados WHERE nickUsuario='".$usuario."')";

			return $this->listarExcursionesDB($sql);

		}

		//Función para desapuntar a un alumno de una excursión
		public function desapuntarAlumno($titulo, $usuario) {

			$titulo = htmlspecialchars($titulo);
			$usuario = htmlspecialchars($usuario);
			
			$sql = "DELETE FROM apuntados WHERE tituloExcursion='".$titulo."' AND nickUsuario='".$usuario."'";

			$result = $this->conexion->query($sql);

		}

		//Función para validar los campos
		public function validarDatos($u, $c) {

				return (is_string($u) & is_string($c));
		}
		
	}

?>