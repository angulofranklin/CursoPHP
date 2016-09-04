<HTML LANG="es">

<HEAD>
   <TITLE>Eliminación de vivienda</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">
</HEAD>

<BODY>

<H1>Eliminación de viviendas</H1>

<?PHP

   $eliminar = $_REQUEST['eliminar'];
   if (isset($eliminar))
   {

   // Conectar con el servidor de base de datos
      $conexion = mysql_connect ("localhost", "root", "Fab10tupapa123456")
         or die ("No se puede conectar con el servidor");

   // Seleccionar base de datos
      mysql_select_db ("lindavista")
         or die ("No se puede seleccionar la base de datos");

   // Obtener número de viviendas a eliminar
      $borrar = $_REQUEST['borrar'];
      $nfilas = count ($borrar);

   // Mostrar viviendas a eliminar
      for ($i=0; $i<$nfilas; $i++)
      {

      // Obtener datos de la vivienda i-ésima
         $instruccion = "select * from viviendas where id = $borrar[$i]";
         $consulta = mysql_query ($instruccion, $conexion)
            or die ("Fallo en la consulta");
         $resultado = mysql_fetch_array ($consulta);

      // Mostrar datos de la vivienda i-ésima
         print ("<P>Vivienda eliminada:</P>\n");
         print ("<UL>\n");
         print ("<LI>Tipo: " . $resultado['tipo']);
         print ("<LI>Zona: " . $resultado['zona']);
         print ("<LI>Dirección: " . $resultado['direccion']);
         print ("<LI>Número de dormitorios: " . $resultado['ndormitorios']);
         print ("<LI>Precio: " . $resultado['precio'] . " &euro;");
         print ("<LI>Tamaño: " . $resultado['tamano'] . " metros cuadrados");
         print ("<LI>Extras: " . $resultado['extras']);

         if ($resultado['foto'] != "")
            print ("<LI>Foto: " . $resultado['foto']);
         else
            print ("<LI>Foto: (no hay)");

         print ("<LI>Observaciones: " . $resultado['observaciones']);
         print ("</UL>\n");

      // Eliminar vivienda
         $instruccion = "delete from viviendas where id = $borrar[$i]";
         $consulta = mysql_query ($instruccion, $conexion)
            or die ("Fallo en la eliminación");

      // Borrar foto asociada si existe
         if ($resultado['foto'] != "")
         {
            $nombreFichero = "fotos/" . $resultado['foto'];
            unlink ($nombreFichero);
         }

      }
      print ("<P>Número total de viviendas eliminadas: $nfilas</P>\n");

   // Cerrar conexión
      mysql_close ($conexion);

      print ("<P>[ <A HREF='practica11.php'>Eliminar más viviendas</A> ]</P>\n");

   }
   else
   {

   // Conectar con el servidor de base de datos
      $conexion = mysql_connect ("localhost", "root", "Fab10tupapa123456")
         or die ("No se puede conectar con el servidor");

   // Seleccionar base de datos
      mysql_select_db ("lindavista")
         or die ("No se puede seleccionar la base de datos");

   // Enviar consulta
      $instruccion = "select * from viviendas order by precio asc";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");

   // Mostrar resultados de la consulta
      $nfilas = mysql_num_rows ($consulta);
      if ($nfilas > 0)
      {
         print ("<FORM ACTION='practica11.php' METHOD='post'>\n");

         print ("<TABLE WIDTH='700'>\n");
         print ("<TR>\n");
         print ("<TH WIDTH='100'>Tipo</TH>\n");
         print ("<TH WIDTH='100'>Zona</TH>\n");
         print ("<TH WIDTH='100'>Dormitorios</TH>\n");
         print ("<TH WIDTH='75'>Precio</TH>\n");
         print ("<TH WIDTH='75'>Tamaño</TH>\n");
         print ("<TH WIDTH='150'>Extras</TH>\n");
         print ("<TH WIDTH='50'>Foto</TH>\n");
         print ("<TH WIDTH='50'>Borrar</TH>\n");
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

            print ("<TD><INPUT TYPE='CHECKBOX' NAME='borrar[]' VALUE='" .
               $resultado['id'] . "'></TD>\n");

            print ("</TR>\n");
         }

         print ("</TABLE>\n");

         print ("<BR>\n");
         print ("<INPUT TYPE='SUBMIT' NAME='eliminar' VALUE='Eliminar viviendas marcadas'>\n");
         print ("</FORM>\n");
      }
      else
         print ("No hay viviendas disponibles");

   // Cerrar conexión
      mysql_close ($conexion);

   }
   
?>

</BODY>
</HTML>
