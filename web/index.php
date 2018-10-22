<?php

	session_start();

	//Cargamos los controladores
	require_once __DIR__ . '/../app/Config.php';
	require_once __DIR__ . '/../app/Model.php';
	require_once __DIR__ . '/../app/Controller.php';

	//Array asociativo y parseamos la ruta. Con esto sabemos la acción que tenemos que lanzar
	$map = array(
		'inicio' => array('controller' => 'Controller', 'action' => 'inicio'),
		'nuevaExcursion' => array('controller' => 'Controller', 'action' => 'nuevaExcursion'),
		'borrarExcursion' => array('controller' => 'Controller', 'action' => 'borrarExcursion'),
		'registrarAlumno' => array('controller' => 'Controller', 'action' => 'registrarAlumno'),
		'borrarAlumno' => array('controller' => 'Controller', 'action' => 'borrarAlumno'),
		'verAlumnos' => array('controller' => 'Controller', 'action' => 'verAlumnos'),
		'verExcursiones' => array('controller' => 'Controller', 'action' => 'verExcursiones'),
		'ver' => array('controller' => 'Controller', 'action' => 'ver'),
		'apuntarse' => array('controller' => 'Controller', 'action' => 'apuntarse'),
		'eliminar' => array('controller' => 'Controller', 'action' => 'eliminar'),
		'logout' => array('controller' => 'Controller', 'action' => 'logout')
	);

	//Parseamos la ruta
	if(isset($_GET['action'])) {

		if(isset($map[$_GET['action']])) {

			$ruta = $_GET['action'];

		} else {

			header('Status: 404 Not Found');
			echo '<html><body><p>Error 404: No existe la ruta '.
			$_GET['action'].'</p></body></html>';
			exit;

		}

	} else {

		$ruta = 'inicio';

	}

	$controlador = $map[$ruta];

	//Ejecutamos el controlador asociado a la ruta
	if(method_exists($controlador['controller'], $controlador['action'])) {

		call_user_func(array(
			new $controlador['controller'], $controlador['action'])
		);

	} else {

		header('Status: 404 Not Found');
		echo '<html><body><p>Error 404: El controlador '.$controlador['controller'].'->'.$controlador['action'].' no existe</p></body></html>';

	}

?>