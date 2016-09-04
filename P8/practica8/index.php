<HTML LANG="es">

<HEAD>
   <TITLE>Inserci�n de vivienda</TITLE>
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
   // Direcci�n
      if (trim($direccion) == "")
      {
         $errores["direccion"] = "�Se requiere la direcci�n de la vivienda!";
         $error = true;
      }
      else
         $errores["direccion"] = " ";
   // Precio
      if (!is_numeric($precio))
      {
         $errores["precio"] = "�El precio debe ser un valor num�rico!";
         $error = true;
      }
      else
         $errores["precio"] = " ";
   // Tama�o
      if (!is_numeric($tamano))
      {
         $errores["tamano"] = "�El tama�o debe ser un valor num�rico!";
         $error = true;
      }
      else
         $errores["tamano"] = " ";

   // Subir fichero con la foto de la vivienda
      $copiarFichero = false;

   // Copiar fichero en directorio de ficheros subidos
   // Se renombra para evitar que sobreescriba un fichero existente
   // Para garantizar la unicidad del nombre se a�ade una marca de tiempo
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
   // El fichero introducido supera el l�mite de tama�o permitido
      else if ($_FILES['foto']['error'] == UPLOAD_ERR_FORM_SIZE)
      {
      	 $maxsize = $_REQUEST['MAX_FILE_SIZE'];
         $errores["foto"] = "�El tama�o del fichero supera el l�mite permitido ($maxsize bytes)!";
         $error = true;
      }
   // No se ha introducido ning�n fichero
      else if ($_FILES['foto']['name'] == "")
         $nombreFichero = '';
   // El fichero introducido no se ha podido subir
      else
      {
         $errores["foto"] = "�No se ha podido subir el fichero!";
         $error = true;
      }
   }

// Si los datos son correctos, procesar formulario
   if (isset($insertar) && $error==false)
   {

   // Mover foto a su ubicaci�n definitiva
      if ($copiarFichero)
         move_uploaded_file ($_FILES['foto']['tmp_name'], $nombreDirectorio . $nombreFichero);

      print ("<H1>Inserci�n de vivienda</H1>\n");
      print ("<P>Estos son los datos introducidos:</P>\n");
      print ("<UL>\n");
      print ("   <LI>Tipo: $tipo\n");
      print ("   <LI>Zona: $zona\n");
      print ("   <LI>Direcci�n: $direccion\n");
      print ("   <LI>N�mero de dormitorios: $ndormitorios\n");
      print ("   <LI>Precio: $precio &euro;\n");
      print ("   <LI>Tama�o: $tamano metros cuadrados\n");
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
      print ("<P>[ <A HREF='practica8.php'>Insertar otra vivienda</A> ]</P>\n");
   }
   else
   {
?>

<H1>Inserci�n de vivienda</H1>

<P>Introduzca los datos de la vivienda:</P>

<FORM CLASS="borde" ACTION="practica8.php" METHOD="POST" ENCTYPE="multipart/form-data">

<P><LABEL>Tipo de vivienda:</LABEL>
<SELECT NAME="tipo">
   <OPTION VALUE="Piso" SELECTED>Piso
   <OPTION VALUE="Adosado">Adosado
   <OPTION VALUE="Chalet">Chalet
   <OPTION VALUE="Casa">Casa
</SELECT></P>

<P><LABEL>Zona:</LABEL>
<SELECT NAME="zona">
   <OPTION VALUE="Centro">Centro
   <OPTION VALUE="Nervi�n">Nervi�n
   <OPTION VALUE="Triana">Triana
   <OPTION VALUE="Aljarafe">Aljarafe
   <OPTION VALUE="Macarena">Macarena
</SELECT></P>

<P><LABEL>Direcci�n:</LABEL>
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

<P><LABEL>N�mero de dormitorios:</LABEL>
<INPUT TYPE="radio" NAME="ndormitorios" VALUE="1">1
<INPUT TYPE="radio" NAME="ndormitorios" VALUE="2">2
<INPUT TYPE="radio" NAME="ndormitorios" VALUE="3" CHECKED>3
<INPUT TYPE="radio" NAME="ndormitorios" VALUE="4">4
<INPUT TYPE="radio" NAME="ndormitorios" VALUE="5">5</P>

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

<P><LABEL>Tama�o:</LABEL>
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
<INPUT TYPE="checkbox" NAME="extras[]" VALUE="Piscina">Piscina
<INPUT TYPE="checkbox" NAME="extras[]" VALUE="Jard�n">Jard�n
<INPUT TYPE="checkbox" NAME="extras[]" VALUE="Garage">Garage</P>

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
