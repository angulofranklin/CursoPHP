<?PHP
   session_start ();
?>
<HTML LANG="es">

<HEAD>
   <TITLE>Gestión de noticias - Inserción de nueva noticia</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">

<?PHP
// Incluir bibliotecas de funciones
   include ("lib/fecha.php");
?>

</HEAD>

<BODY>

<?PHP
   if (isset($_SESSION["usuario_valido"]))
   {
?>

<?PHP
   //////////////////////////////////////////////////////////////////////////
   // si el formulario ha sido enviado
   //    validar formulario
   // fsi
   // si el formulario ha sido enviado y los datos son correctos
   //    procesar formulario
   // si no
   //    mostrar formulario
   // fsi
   //////////////////////////////////////////////////////////////////////////

// Obtener valores introducidos en el formulario
   $insertar = $_REQUEST['insertar'];
   $titulo = $_REQUEST['titulo'];
   $texto = $_REQUEST['texto'];
   $categoria = $_REQUEST['categoria'];

   $error = false;
   if (isset($insertar))
   {

   // Comprobar que se han introducido todos los datos obligatorios
   // Título
      if (trim($titulo) == "")
      {
         $errores["titulo"] = "¡Debe introducir el título de la noticia!";
         $error = true;
      }
      else
         $errores["titulo"] = "";

   // Texto
      if (trim($texto) == "")
      {
         $errores["texto"] = "¡Debe introducir el texto de la noticia!";
         $error = true;
      }
      else
         $errores["texto"] = "";

   // Subir fichero
      $copiarFichero = false;

   // Copiar fichero en directorio de ficheros subidos
   // Se renombra para evitar que sobreescriba un fichero existente
   // Para garantizar la unicidad del nombre se añade una marca de tiempo
      if (is_uploaded_file ($_FILES['imagen']['tmp_name']))
      {
         $nombreDirectorio = "img/";
         $nombreFichero = $_FILES['imagen']['name'];
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
      else if ($_FILES['imagen']['error'] == UPLOAD_ERR_FORM_SIZE)
      {
      	 $maxsize = $_REQUEST['MAX_FILE_SIZE'];
         $errores["imagen"] = "¡El tamaño del fichero supera el límite permitido ($maxsize bytes)!";
         $error = true;
      }
   // No se ha introducido ningún fichero
      else if ($_FILES['imagen']['name'] == "")
         $nombreFichero = '';
   // El fichero introducido no se ha podido subir
      else
      {
         $errores["imagen"] = "¡No se ha podido subir el fichero!";
         $error = true;
      }
   }
   
// Si los datos son correctos, procesar formulario
   if (isset($insertar) && $error==false)
   {

   // Insertar la noticia en la Base de Datos
      $conexion = mysql_connect ("localhost", "cursophp-ad", "php.hph")
         or die ("No se puede conectar con el servidor");
      mysql_select_db ("lindavista")
         or die ("No se puede seleccionar la base de datos");

      $fecha = date ("Y-m-d"); // Fecha actual
      $instruccion = "insert into noticias (titulo, texto, categoria, fecha, imagen) values ('$titulo', '$texto', '$categoria', '$fecha', '$nombreFichero')";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");
      mysql_close ($conexion);

   // Mover fichero de imagen a su ubicación definitiva
      if ($copiarFichero)
         move_uploaded_file ($_FILES['imagen']['tmp_name'],
         $nombreDirectorio . $nombreFichero);

   // Mostrar datos introducidos
      print ("<H1>Gestión de noticias</H1>\n");
      print ("<H2>Resultado de la inserción de nueva noticia</H2>\n");

      print ("<P>La noticia ha sido recibida correctamente:</P>\n");
      print ("<UL>\n");
      print ("   <LI>Título: " . $titulo . "\n");
      print ("   <LI>Texto: " . $texto . "\n");
      print ("   <LI>Categoría: " . $categoria . "\n");
      print ("   <LI>Fecha: " . date2string($fecha) . "\n");
      if ($nombreFichero != "")
         print ("   <LI>Imagen: <A TARGET='_blank' HREF='" . $nombreDirectorio . $nombreFichero . "'>" . $nombreFichero . "</A>\n");
      else
         print ("   <LI>Imagen: (no hay)\n");
      print ("</UL>\n");

      print ("<P>[ <A HREF='inserta_noticia.php'>Insertar otra noticia</A> | ");
      print ("<A HREF='login.php'>Menú principal</A> ]</P>\n");

   }
   else
   {
?>

<H1>Gestión de noticias</H1>

<H2>Insertar nueva noticia</H2>

<FORM CLASS="borde" ACTION="inserta_noticia.php" NAME="inserta" METHOD="POST"
   ENCTYPE="multipart/form-data">

<!-- Título de la noticia -->
<P><LABEL>Título: *</LABEL>
<INPUT TYPE="TEXT" NAME="titulo" SIZE="50" MAXLENGTH="50"

<?PHP
   if (isset($insertar))
      print ("VALUE='$titulo'>\n");
   else
      print (">\n");
   if ($errores["titulo"] != "")
      print ("<BR><SPAN CLASS='error'>" . $errores["titulo"] . "</SPAN>");
?>
</P>

<!-- Texto de la noticia-->
<P><LABEL>Texto: *</LABEL>
<TEXTAREA COLS="45" ROWS="5" NAME="texto">
<?PHP
   if (isset($insertar))
      print ("$texto");
   print ("</TEXTAREA>");
   if ($errores["texto"] != "")
      print ("<BR><SPAN CLASS='error'>" . $errores["texto"] . "</SPAN>");
?>
</P>

<!-- Categoría de la noticia-->
<P><LABEL>Categoría:</LABEL>
<SELECT NAME="categoria">
   <OPTION SELECTED>promociones
   <OPTION>ofertas
   <OPTION>costas
</SELECT></P>

<!-- Imagen asociada a la noticia -->
<P><LABEL>Imagen:</LABEL>
<INPUT TYPE="HIDDEN" NAME="MAX_FILE_SIZE" VALUE="102400">
<INPUT TYPE="FILE" SIZE="44" NAME="imagen">

<?PHP
   if ($errores["imagen"] != "")
      print ("<BR><SPAN CLASS='error'>" . $errores["imagen"] . "</SPAN>");
?>
</P>

<!-- Botón de envío -->
<P><INPUT TYPE="SUBMIT" NAME="insertar" VALUE="Insertar noticia"></P>

</FORM>

<P>NOTA: los datos marcados con (*) deben ser rellenados obligatoriamente</P>

<P>[ <A HREF='login.php'>Menú principal</A> ]</P>

<?PHP
   }
?>

<?PHP

   }
   else
   {
      print ("<BR><BR>\n");
      print ("<P ALIGN='CENTER'>Acceso no autorizado</P>\n");
      print ("<P ALIGN='CENTER'>[ <A HREF='login.php' TARGET='_top'>Conectar</A> ]</P>\n");
   }

?>

</BODY>
</HTML>
