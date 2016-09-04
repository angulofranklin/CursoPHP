<HTML LANG="es">

<HEAD>
   <TITLE>Inserción de vivienda</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">
</HEAD>

<BODY>

<?PHP
   $insertar = $_REQUEST['insertar'];
   if (isset($insertar))
   {

   // Obtener valores introducidos en el formulario
      $tipo = $_REQUEST['tipo'];
      $zona = $_REQUEST['zona'];
      $direccion = $_REQUEST['direccion'];
      $ndormitorios = $_REQUEST['ndormitorios'];
      $precio = $_REQUEST['precio'];
      $tamano = $_REQUEST['tamano'];
      $extras = $_REQUEST['extras'];
      $observaciones = $_REQUEST['observaciones'];

      print ("<H1>Inserción de vivienda</H1>\n");

   // Comprobar que se han introducido todos los datos obligatorios
      $errores = "";
      if (trim($direccion) == "")
         $errores = $errores . "   <LI>Se requiere la dirección de la vivienda\n";
      if (!is_numeric($tamano))
         $errores = $errores . "   <LI>El tamaño debe ser un valor numérico\n";
      if (!is_numeric($precio))
         $errores = $errores . "   <LI>El precio debe ser un valor numérico\n";

   // Mostrar errores encontrados
      if ($errores != "")
      {
         print ("<P>No se ha podido realizar la inserción debido a los siguientes errores:</P>\n");
         print ("<UL>");
         print ($errores);
         print ("</UL>");
         print ("<P>[ <A HREF='javascript:history.back()'>Volver</A> ]</P>\n");
      }
      else
      {
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

         print ("   <LI>Observaciones: $observaciones\n");
         print ("</UL>\n");
         print ("<P>[ <A HREF='practica6b.php'>Insertar otra vivienda</A> ]</P>");
      }
   }
   else
   {
?>

<H1>Inserción de vivienda</H1>

<P>Introduzca los datos de la vivienda:</P>

<FORM CLASS="borde" ACTION="practica6b.php" METHOD="POST">

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
   <OPTION VALUE="Nervión">Nervión
   <OPTION VALUE="Triana">Triana
   <OPTION VALUE="Aljarafe">Aljarafe
   <OPTION VALUE="Macarena">Macarena
</SELECT></P>

<P><LABEL>Dirección:</LABEL>
<INPUT TYPE="TEXT" NAME="direccion"></P>

<P><LABEL>Número de dormitorios:</LABEL>
<INPUT TYPE="radio" NAME="ndormitorios" VALUE="1">1
<INPUT TYPE="radio" NAME="ndormitorios" VALUE="2">2
<INPUT TYPE="radio" NAME="ndormitorios" VALUE="3" CHECKED>3
<INPUT TYPE="radio" NAME="ndormitorios" VALUE="4">4
<INPUT TYPE="radio" NAME="ndormitorios" VALUE="5">5</P>

<P><LABEL>Precio:</LABEL>
<INPUT TYPE="TEXT" NAME="precio"> &euro;</P>

<P><LABEL>Tamaño:</LABEL>
<INPUT TYPE="TEXT" NAME="tamano"> metros cuadrados</P>

<P><LABEL>Extras (marque los que procedan):</LABEL>
<INPUT TYPE="checkbox" NAME="extras[]" VALUE="Piscina">Piscina
<INPUT TYPE="checkbox" NAME="extras[]" VALUE="Jardín">Jardín
<INPUT TYPE="checkbox" NAME="extras[]" VALUE="Garage">Garage</P>

<P><LABEL>Observaciones:</LABEL>
<TEXTAREA NAME="observaciones" COLS="50" ROWS="5"></TEXTAREA></P>

<P><INPUT TYPE="submit" NAME="insertar" VALUE="Insertar vivienda"></P>

</FORM>

<?PHP
   }
?>

</BODY>
</HTML>
