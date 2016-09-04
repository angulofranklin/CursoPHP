<HTML LANG="es">

<HEAD>
   <TITLE>Consulta de viviendas</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">

<SCRIPT LANGUAGE='JavaScript'>
<!--
// Función que actualiza la página al cambiar el tipo de vivienda
   function actualizaPagina ()
   {
      i = document.forms.selecciona.tipo.selectedIndex;
      tipo = document.forms.selecciona.tipo.options[i].value;
      window.location = 'practica12c.php?tipo=' + tipo;
   }
// -->
</SCRIPT>

</HEAD>

<BODY>

<H1>Consulta de viviendas</H1>

<?PHP

   // Conectar con el servidor de base de datos
      $conexion = mysql_connect ("localhost", "root", "Fab10tupapa123456")
         or die ("No se puede conectar con el servidor");

   // Seleccionar base de datos
      mysql_select_db ("lindavista")
         or die ("No se puede seleccionar la base de datos");

   // Mostrar formulario con elemento SELECT para seleccionar tipo de vivienda
      print ("<FORM NAME='selecciona' ACTION='practica12c.php' METHOD='POST'>\n");
      print ("<P>Mostrar viviendas de tipo:\n");
      print ("<SELECT NAME='tipo' ONCHANGE='actualizaPagina()'>\n");

   // Obtener los valores del tipo enumerado
      $instruccion = "SHOW columns FROM viviendas LIKE 'tipo'";
      $consulta = mysql_query ($instruccion, $conexion);
      $row = mysql_fetch_array ($consulta);

   // Pasar los valores a una tabla y añadir el valor "Todos" al principio
      $lis = strstr ($row[1], "(");
      $lis = ltrim ($lis, "(");
      $lis = rtrim ($lis, ")");
      $lis = "'Todos'," . $lis;
      $lista = explode (",", $lis);

   // Mostrar cada valor en un elemento OPTION
      $tipo = $_REQUEST['tipo'];
      if (isset($tipo))
         $selected = $tipo;
      else
         $selected = "Todos";
      for ($i=0; $i<count($lista); $i++)
      {
         $cad = trim ($lista[$i], "'");
         if ($cad == $selected)
            print ("   <OPTION VALUE='$cad' SELECTED>$cad\n");
         else
            print ("   <OPTION VALUE='$cad'>$cad\n");
      }

      print ("</SELECT></P>\n");
      print ("</FORM>\n");

   // Enviar consulta
      $instruccion = "select * from viviendas";

      if (isset($tipo) && $tipo != "Todos")
         $instruccion = $instruccion . " where tipo='$tipo'";

      $instruccion = $instruccion . " order by precio asc";
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

?>

</BODY>
</HTML>
