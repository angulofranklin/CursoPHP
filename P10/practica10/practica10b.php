<HTML LANG="es">

<HEAD>
   <TITLE>Inserción de vivienda</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">
</HEAD>

<BODY>

<?PHP
// Obtener valores introducidos en el formulario
   $insertar = $_REQUEST['insertar'];
   $tipo = $_REQUEST['tipo'];
   $zona = $_REQUEST['zona'];
   $direccion = $_REQUEST['direccion'];
   $ndormitorios = $_REQUEST['ndormitorios'];
   $precio = $_REQUEST['precio'];
   $tamano = $_REQUEST['tamano'];
   $extras = $_REQUEST['extras'];
   $observaciones = $_REQUEST['observaciones'];

   $error = false;
   if (isset($insertar))
   {

   // Comprobar errores
   // Dirección
      if (trim($direccion) == "")
      {
         $errores["direccion"] = "¡Se requiere la dirección de la vivienda!";
         $error = true;
      }
      else
         $errores["direccion"] = "";
   // Precio
      if (!is_numeric($precio))
      {
         $errores["precio"] = "¡El precio debe ser un valor numérico!";
         $error = true;
      }
      else
         $errores["precio"] = "";
   // Tamaño
      if (!is_numeric($tamano))
      {
         $errores["tamano"] = "¡El tamaño debe ser un valor numérico!";
         $error = true;
      }
      else
         $errores["tamano"] = "";

   // Subir fichero con la foto de la vivienda
      $copiarFichero = false;

   // Copiar fichero en directorio de ficheros subidos
   // Se renombra para evitar que sobreescriba un fichero existente
   // Para garantizar la unicidad del nombre se añade una marca de tiempo
      if (is_uploaded_file ($_FILES['foto']['tmp_name']))
      {
         $nombreDirectorio = "fotos/";
         $nombreFichero = $_FILES['foto']['name'];
         $copiarFichero = true;

      // Si ya existe un fichero con el mismo nombre, renombrarlo
         $nombreCompleto = $nombreDirectorio . $nombreFichero;
         if (is_file($nombreCompleto))
         {
            $idUnico = time();
            $nombreFichero = $idUnico . "-" . $nombreFichero;
         }
      }
   // El fichero introducido supera el límite de tamaño permitido
      else if ($_FILES['foto']['error'] == UPLOAD_ERR_FORM_SIZE)
      {
      	 $maxsize = $_REQUEST['MAX_FILE_SIZE'];
         $errores["foto"] = "¡El tamaño del fichero supera el límite permitido ($maxsize bytes)!";
         $error = true;
      }
   // No se ha introducido ningún fichero
      else if ($_FILES['foto']['name'] == "")
         $nombreFichero = '';
   // El fichero introducido no se ha podido subir
      else
      {
         $errores["foto"] = "¡No se ha podido subir el fichero!";
         $error = true;
      }
   }

// Si los datos son correctos, procesar formulario
   if (isset($insertar) && $error==false)
   {

   // Insertar la vivienda en la Base de Datos
      $conexion = mysql_connect ("localhost", "cursophp-ad", "php.hph")
         or die ("No se puede conectar con el servidor");
      mysql_select_db ("lindavista")
         or die ("No se puede seleccionar la base de datos");

      $n = count ($extras);
      if ($n > 0)
      {
         $ex = $extras[0];
         for ($i=1; $i<$n; $i++)
            $ex = $ex . "," . $extras[$i];
      }
      else
         $ex = "";

      $instruccion = "insert into viviendas (tipo, zona, direccion, ndormitorios, " .
                     "precio, tamano, extras, foto, observaciones) values " .
                     "('$tipo', '$zona', '$direccion', '$ndormitorios', " .
                     "'$precio', '$tamano', '$ex', '$nombreFichero', '$observaciones')";

      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la inserción");
      mysql_close ($conexion);

   // Mover foto a su ubicación definitiva
      if ($copiarFichero)
         move_uploaded_file ($_FILES['foto']['tmp_name'], $nombreDirectorio . $nombreFichero);

      print ("<H1>Inserción de vivienda</H1>\n");
      print ("<P>Estos son los datos introducidos:</P>\n");
      print ("<UL>\n");
      print ("   <LI>Tipo: $tipo\n");
      print ("   <LI>Zona: $zona\n");
      print ("   <LI>Dirección: $direccion\n");
      print ("   <LI>Número de dormitorios: $ndormitorios\n");
      print ("   <LI>Precio: $precio &euro;\n");
      print ("   <LI>Tamaño: $tamano metros cuadrados\n");
      print ("   <LI>Extras: ");

      foreach ($extras as $extra)
         print ($extra . " ");
      print ("\n");

      if ($copiarFichero == true)
         print ("   <LI>Foto: <A TARGET='_blank' HREF='$nombreDirectorio$nombreFichero'>$nombreFichero</A>\n");
      else
         print ("   <LI>Foto: (no hay)\n");

      print ("   <LI>Observaciones: $observaciones\n");
      print ("</UL>\n");
      print ("<P>[ <A HREF='practica10b.php'>Insertar otra vivienda</A> ]</P>\n");
   }
   else
   {
?>

<H1>Inserción de vivienda</H1>

<P>Introduzca los datos de la vivienda:</P>

<FORM CLASS="borde" ACTION="practica10b.php" METHOD="POST" ENCTYPE="multipart/form-data">

<P><LABEL>Tipo de vivienda:</LABEL>
<SELECT NAME="tipo">

<?PHP
// Conectar con el servidor
   $conexion = mysql_connect ("localhost", "cursophp", "")
      or die ("No se puede conectar con el servidor");
   mysql_select_db ("lindavista")
      or die ("No se puede seleccionar la base de datos");

// Obtener los valores del tipo enumerado
   $instruccion = "SHOW columns FROM viviendas LIKE 'tipo'";
   $consulta = mysql_query ($instruccion, $conexion);
   $row = mysql_fetch_array ($consulta);

// Pasar los valores a una tabla
   $lis = strstr ($row[1], "(");
   $lis = ltrim ($lis, "(");
   $lis = rtrim ($lis, ")");
   $lista = explode (",", $lis);

// Mostrar cada valor en un elemento OPTION
   if (isset($insertar))
      $selected = $tipo;
   else
      $selected = "";
   for ($i=0; $i<count($lista); $i++)
   {
      $cad = trim ($lista[$i], "'");
      if ($cad == $selected)
         print ("<OPTION SELECTED>" . $cad . "\n");
      else
         print ("<OPTION>" . $cad . "\n");
   }
?>

</SELECT></P>

<P><LABEL>Zona:</LABEL>
<SELECT NAME="zona">

<?PHP
// Obtener los valores del tipo enumerado
   $instruccion = "SHOW columns FROM viviendas LIKE 'zona'";
   $consulta = mysql_query ($instruccion, $conexion);
   $row = mysql_fetch_array ($consulta);

// Pasar los valores a una tabla
   $lis = strstr ($row[1], "(");
   $lis = ltrim ($lis, "(");
   $lis = rtrim ($lis, ")");
   $lista = explode (",", $lis);

// Mostrar cada valor en un elemento OPTION
   if (isset($insertar))
      $selected = $zona;
   else
      $selected = "";
   for ($i=0; $i<count($lista); $i++)
   {
      $cad = trim ($lista[$i], "'");
      if ($cad == $selected)
         print ("<OPTION SELECTED>" . $cad . "\n");
      else
         print ("<OPTION>" . $cad . "\n");
   }
?>

</SELECT></P>

<P><LABEL>Dirección:</LABEL>
<INPUT TYPE="TEXT" NAME="direccion"

<?PHP
   if (isset($insertar))
      print (" VALUE='$direccion'>\n");
   else
      print (">\n");
   if ($errores["direccion"] != "")
      print ("<BR><SPAN CLASS='error'>" . $errores["direccion"] . "</SPAN>");
?>
</P>

<P><LABEL>Número de dormitorios:</LABEL>

<?PHP
// Obtener los valores del tipo enumerado
   $instruccion = "SHOW columns FROM viviendas LIKE 'ndormitorios'";
   $consulta = mysql_query ($instruccion, $conexion);
   $row = mysql_fetch_array ($consulta);

// Pasar los valores a una tabla
   $lis = strstr ($row[1], "(");
   $lis = ltrim ($lis, "(");
   $lis = rtrim ($lis, ")");
   $lista = explode (",", $lis);

// Mostrar cada valor en un elemento RADIO
   if (isset($insertar))
      $checked = $ndormitorios;
   else
      $checked = 3;
   for ($i=0; $i<count($lista); $i++)
   {
      $cad = trim ($lista[$i], "'");
      if ($cad == $checked)
         print ("<INPUT TYPE='radio' NAME='ndormitorios' VALUE='$cad' CHECKED>$cad\n");
      else
         print ("<INPUT TYPE='radio' NAME='ndormitorios' VALUE='$cad'>$cad\n");
   }
?>

</P>

<P><LABEL>Precio:</LABEL>
<INPUT TYPE="TEXT" NAME="precio"

<?PHP
   if (isset($insertar))
      print (" VALUE='$precio'> &euro;\n");
   else
      print ("> &euro;\n");
   if ($errores["precio"] != "")
      print ("<BR><SPAN CLASS='error'>" . $errores["precio"] . "</SPAN>");
?>
</P>

<P><LABEL>Tamaño:</LABEL>
<INPUT TYPE="TEXT" NAME="tamano"

<?PHP
   if (isset($insertar))
      print (" VALUE='$tamano'> metros cuadrados\n");
   else
      print ("> metros cuadrados\n");
   if ($errores["tamano"] != "")
      print ("<BR><SPAN CLASS='error'>" . $errores["tamano"] . "</SPAN>");
?>
</P>

<P><LABEL>Extras (marque los que procedan):</LABEL>

<?PHP
// Obtener los valores del tipo enumerado
   $instruccion = "SHOW columns FROM viviendas LIKE 'extras'";
   $consulta = mysql_query ($instruccion, $conexion);
   $row = mysql_fetch_array ($consulta);

// Pasar los valores a una tabla
   $lis = strstr ($row[1], "(");
   $lis = ltrim ($lis, "(");
   $lis = rtrim ($lis, ")");
   $lista = explode (",", $lis);

// Mostrar cada valor en un elemento CHECKBOX
   for ($i=0; $i<count($lista); $i++)
   {
      $cad = trim ($lista[$i], "'");
      if (isset($insertar) && in_array($cad, $extras))
         print ("<INPUT TYPE='checkbox' NAME='extras[]' VALUE='$cad' CHECKED>$cad\n");
      else
         print ("<INPUT TYPE='checkbox' NAME='extras[]' VALUE='$cad'>$cad\n");
   }

// Cerrar conexión
   mysql_close ($conexion);
?>

</P>

<P><LABEL>Foto:</LABEL>
<INPUT TYPE="HIDDEN" NAME="MAX_FILE_SIZE" VALUE="102400">
<INPUT TYPE="FILE" NAME="foto">

<?PHP
   if ($errores["foto"] != "")
      print ("<BR><SPAN CLASS='error'>" . $errores["foto"] . "</SPAN>");
?>
</P>

<P><LABEL>Observaciones:</LABEL>
<TEXTAREA NAME="observaciones" COLS="50" ROWS="5"></TEXTAREA></P>

<P><INPUT TYPE="submit" NAME="insertar" VALUE="Insertar vivienda"></P>

</FORM>

<?PHP
   }
?>

</BODY>
</HTML>
