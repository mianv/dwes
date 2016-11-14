<?php
/**
*  Agenda para la actividad C02P03.
*
*  Esta agenda mantiene, en la sesión actual del navegador, un registro de nombres
*  y sus correspondientes números de teléfono, siguiendo las siguientes directrices:
*    -Si el nombre está vacío, muestra una advertencia.
*    -Si el nombre introducido no existe en la agenda y el campo de teléfono no
*     está vacío, los agrega a la lista.
*    -Si el nombre ya existe en la lista y se indica un número de teléfono diferente
*     al actual, se sustituye el número de teléfono anterior por éste.
*    -Si el nombre introducido ya exite pero no se indica teléfono, se borra al
*     nombre y su teléfono correspondiente de la lista.
*
*  Todo esto se lleva a cabo utilizando un campo de formulario oculto.
*
*  @author m.angel [miquelangel.vf@gmail.com]
*/
if ($_POST) {
  $name = $_POST['name'];
  $phone = $_POST['phone'];

  $agenda = json_decode($_POST['stored_data'], true);

  if (!empty($name) && !empty($phone)) {
      $agenda[$name] = $phone;
  } elseif (isset($name) && empty($phone)) {
      unset($agenda[$name]);
  }
}
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Agenda</title>
	<style media="screen">
		* {
			margin: auto;
			font-family: sans-serif;
		}
		.container {
			width: 40%;
			margin-top: 1.5em;
			padding: 1em;
			background-color: #F1F1F1;
			box-shadow: 3px 3px 5px 5px darkgrey;
		}
		table, th, td {
			text-align: center;
			width: 100%;
			border: 1px solid lightgray;
			border-collapse: collapse;
			background-color: white;
		}
		th, td {
			width: 50%;
		}

	</style>
</head>
<body>
<div class="container">
	<form action="index.php" method="POST">
		<fieldset>
			<legend>Agenda</legend>
			<input type="text" name="name" id="name" placeholder="Nombre" required>
			<input type="text" name="phone" id="phone" placeholder="Telefono" pattern="[0-9]{9}">
			<input type="submit" value="Actualizar">
			<input type="hidden" name="stored_data" value='<?php echo json_encode($agenda); ?>'>
		</fieldset>
		<br>
		<?php
        /**
         *  En esta sección se genera la tabla con los contactos sólo en en el caso de
         *  que los campos no estén vacíos.
         *
         *  Para generar la tabla se recorre el array usando como clave el nombre
         *  que está almacenado en este.
         */
        if (!empty($agenda)) {
            echo '<table>';
            echo '<tr>';
            echo '<th>Nombre</th>';
            echo '<th>Teléfono</th>';
            echo '</tr>';

            foreach ($agenda as $name => $phone) {
                echo '<tr>';
                echo "<td>$name</td>"."<td>$phone</td>";
                echo '</tr>';
            }
            echo '</table>';
        }
         ?>
		</form>
	</div>
</body>
</html>
