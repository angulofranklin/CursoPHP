<HTML LANG="es">

<HEAD>
   <TITLE>Búsqueda de vivienda</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">
</HEAD>

<BODY>

<?PHP
// Obtener valores introducidos en el formulario
   $buscar = $_REQUEST['buscar'];
   $tipo = $_REQUEST['tipo'];
   $zona = $_REQUEST['zona'];
   $ndormitorios = $_REQUEST['ndormitorios'];
   $precio = $_REQUEST['precio'];
   $extras = $_REQUEST['extras'];

   $error = false;
   if (isset($buscar))
   {

   // Comprobar errores
   // Tipo
      if ($tipo == "Seleccione:")
      {
         $errores["tipo"] = "Debe seleccionar un tipo de vivienda";
      	 $error = true;
      }
      else
         $errores["tipo"] = "";
   
   // Zona
      if ($zona == "Seleccione:")
      {
         $errores["zona"] = "Debe seleccionar la zona donde buscar la vivienda";
      	 $error = true;
      }
      else
         $errores["zona"] = "";
   }

// Si los datos son correctos, procesar formulario
   if (isset($buscar) && $error==false)
   {

   // Conectar con el servidor de base de datos
      $conexion = mysql_connect ("localhost", "cursophp", "")
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


      print ("<P>[ <A HREF='busca_vivienda.php'>Buscar otra vivienda</A> ]</P>\n");
   }
   else
   {
?>

<H1>Búsqueda de vivienda</H1>

<P>Introduzca los datos de la vivienda:</P>

<FORM CLASS="borde" ACTION="busca_vivienda.php" METHOD="POST">

<P><LABEL>Tipo:</LABEL>
<SELECT NAME="tipo">
<?PHP
   $tipos = array ("Seleccione:", "Piso", "Adosado", "Chalet", "Casa");
   $default ="Seleccione:";
   if (isset($buscar)) $default = $tipo;
   foreach ($tipos as $t)
      if ($t == $default) 
         print ("<OPTION VALUE='$t' SELECTED>$t\n");
      else  
         print ("<OPTION VALUE='$t'>$t\n");
   print ("</SELECT>\n");
   if ($errores["tipo"] != "")
      print ("<BR><SPAN CLASS='error'>" . $errores["tipo"] . "</SPAN>");
?>
</P>

<P><LABEL>Zona:</LABEL>
<SELECT NAME="zona">
<?PHP
   $zonas = array ("Seleccione:", "Centro", "Nervión", "Triana", "Aljarafe",
                   "Macarena");
   $default ="Seleccione:";
   if (isset($buscar)) $default = $zona;
   foreach ($zonas as $z)
      if ($z == $default) 
         print ("<OPTION VALUE='$z' SELECTED>$z\n");
      else  
         print ("<OPTION VALUE='$z'>$z\n");
   print ("</SELECT>\n");
   if ($errores["zona"] != "")
      print ("<BR><SPAN CLASS='error'>" . $errores["zona"] . "</SPAN>");
?>
</P>

<P><LABEL>Dormitorios:</LABEL>
<?PHP
   $default = 3;
   if (isset($buscar)) $default = $ndormitorios;
   for ($i=1; $i<=5;$i++)
      if ($i == $default)
         print ("<INPUT TYPE='radio' NAME='ndormitorios' VALUE='$i' CHECKED>$i\n");
      else
         print ("<INPUT TYPE='radio' NAME='ndormitorios' VALUE='$i'>$i\n");
?>
</P>

<P><LABEL>Precio (&euro;)</LABEL>
<?PHP
   $precios = array ("000100"=>"<100.000", "100200"=>"100.000-200.000",
                     "200300"=>"200.000-300.000", "300900"=>">300.000");
   $default = "200300";
   if (isset($buscar)) $default = $precio;
   foreach ($precios as $k => $v)
      if ($k == $default)
         print ("<INPUT TYPE='radio' NAME='precio' VALUE='$k' CHECKED>$v\n");
      else
         print ("<INPUT TYPE='radio' NAME='precio' VALUE='$k'>$v\n");
?>
</P>

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

<P><INPUT TYPE="submit" NAME="buscar" VALUE="Buscar vivienda"></P>

</FORM>

<?PHP
   }
?>

</BODY>
</HTML>