<?php ob_start() ?>

<h1>Login</h1>

<?php if(isset($params['mensaje'])): ?>

	<div class="mensaje"><?php echo $params['mensaje'] ?></div>

	<?php endif; ?>

	<form name="formLogin" action="index.php?action=inicio" method="POST">
		<label for="usuario">Usuario</label>
		<input type="text" name="usuario" id="usuario" value="" placeholder="Usuario" />

		<label for="contrasena">Contraseña</label>
		<input type="password" name="contrasena" id="contrasena" value="" placeholder="Contraseña" />

		<input type="submit" value="Entrar" name="login" />
		
	</form>

	<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?> 