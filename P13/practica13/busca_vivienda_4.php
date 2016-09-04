<?PHP
// Iniciar sesión
   session_start ();
?>

<HTML LANG="es">

<HEAD>
   <TITLE>Búsqueda de vivienda</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">

   <SCRIPT LANGUAGE='JavaScript'>
   <!--
      function cargaPagina (pagina)
      {
         window.location=pagina;
      }
   // -->
   </SCRIPT>

</HEAD>

<BODY>

<H1>Búsqueda de vivienda</H1>

<?PHP
// Obtener valores introducidos en el formulario
   $buscar = $_REQUEST['buscar'];
   $extras = $_REQUEST['extras'];

// Obtener valores almacenados en la sesión
   $tipo = $_SESSION['tipo'];
   $zona = $_SESSION['zona'];
   $ndormitorios = $_SESSION['ndormitorios'];
   $precio = $_SESSION['precio'];

   $error = false;
   if (isset($buscar))
   {
   // Comprobar errores
   // Extras
   // Aquí habría que comprobar que todos los elementos de la tabla extras
   // son válidos
   }

// Si los datos son correctos, procesar formulario
   if (isset($buscar) && $error==false)
   {

   // Conectar con el servidor de base de datos
      $conexion = mysql_connect ("localhost", "root", "Fab10tupapa123456")
         or die ("No se puede conectar con el servidor");

   // Seleccionar base de datos
      mysql_select_db ("lindavista")
         or die ("No se puede seleccionar la base de datos");

   // Crear criterio de búsqueda
      $where = "tipo = '$tipo'";
      $where = $where . " and zona = '$zona'";
      $where = $where . " and ndormitorios = '$ndormitorios'";
      $precio1 = substr ($precio, 0, 3) . "000";
      $precio2 = substr ($precio, 3, 3) . "000";
      $where = $where . " and precio >= '$precio1' and precio <= '$precio2'";
      $n = count ($extras);
      if ($n > 0)
      {
         $ex = $extras[0];
         for ($i=1; $i<$n; $i++)
            $ex = $ex . "," . $extras[$i];
         $where = $where . " and extras = '$ex'";
      }

   // Enviar consulta
      $instruccion = "select * from viviendas where $where order by precio asc";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");

   // Mostrar resultados de la consulta
      $nfilas = mysql_num_rows ($consulta);
      if ($nfilas > 0)
      {
         print ("<P>Vivienda(s) encontradas(s):</P>\n");
         print ("<TABLE WIDTH='650'>\n");
         print ("<TR>\n");
         print ("<TH WIDTH='100'>Tipo</TH>\n");
         print ("<TH WIDTH='100'>Zona</TH>\n");
         print ("<TH WIDTH='100'>Dormitorios</TH>\n");
         print ("<TH WIDTH='75'>Precio</TH>\n");
         print ("<TH WIDTH='75'>Tamaño</TH>\n");
         print ("<TH WIDTH='150'>Extras</TH>\n");
         print ("<TH WIDTH='50'>Foto</TH>\n");
         print ("</TR>\n");

         for ($i=0; $i<$nfilas; $i++)
         {
            $resultado = mysql_fetch_array ($consulta);
            print ("<TR>\n");
            print ("<TD>" . $resultado['tipo'] . "</TD>\n");
            print ("<TD>" . $resultado['zona'] . "</TD>\n");
            print ("<TD>" . $resultado['ndormitorios'] . "</TD>\n");
            print ("<TD>" . $resultado['precio'] . "</TD>\n");
            print ("<TD>" . $resultado['tamano'] . "</TD>\n");
            print ("<TD>" . $resultado['extras'] . "</TD>\n");

            if ($resultado['foto'] != "")
               print ("<TD><A TARGET='_blank' HREF='fotos/" . $resultado['foto'] .
                      "'><IMG BORDER='0' SRC='fotos/ico-fichero.gif' ALT='Foto'></A></TD>\n");
            else
               print ("<TD>&nbsp;</TD>\n");

            print ("</TR>\n");
         }

         print ("</TABLE>\n");
      }
      else
         print ("No hay viviendas disponibles");

   // Cerrar conexión
      mysql_close ($conexion);

      print ("<P>[ <A HREF='busca_vivienda_1.php'>Buscar otra vivienda</A> ]</P>\n");
   }
   else
   {
?>

<P CLASS="paso">1. Tipo > 2. Zona > 3. Características > <SPAN CLASS="pasoactual">4. Extras</SPAN></P>

<H2>Paso 4: Elija las características extra de la vivienda</H2>

<FORM CLASS="borde" ACTION="busca_vivienda_4.php" METHOD="POST">

<P><LABEL>Extras:</LABEL>
<?PHP
   $extrasTotales = array ("Piscina", "Jardín", "Garage");
   foreach ($extrasTotales as $e)
      if (isset($buscar) && (in_array ($e, $extras)))
         print ("<INPUT TYPE='checkbox' NAME='extras[]' VALUE='$e' CHECKED>$e\n");
      else
         print ("<INPUT TYPE='checkbox' NAME='extras[]' VALUE='$e'>$e\n");
?>
</P>

<P><INPUT TYPE="BUTTON" VALUE="< Anterior" ONCLICK="cargaPagina('busca_vivienda_3.php')">
<INPUT TYPE="submit" NAME="buscar" VALUE="Finalizar"></P>

</FORM>

<?PHP
// Mostrar datos recogidos
   $precios = array ("000100"=>"<100.000", "100200"=>"100.000-200.000",
                     "200300"=>"200.000-300.000", "300900"=>">300.000");
   print ("<P>Buscando $tipo en $zona con $ndormitorios dormitorios y ");
   print ("precio " . $precios[$precio] . "</P>\n");
   }
?>

</BODY>
</HTML>