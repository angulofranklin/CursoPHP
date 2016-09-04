<HTML LANG="es">

<HEAD>
   <TITLE>Consulta de viviendas</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">
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

   // Establecer el n�mero de filas por p�gina y la fila inicial
      $num = 5; // n�mero de filas por p�gina
      $comienzo = $_REQUEST['comienzo'];
      if (!isset($comienzo)) $comienzo = 0;

   // Calcular el n�mero total de filas de la tabla
      $instruccion = "select * from viviendas";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");
      $nfilas = mysql_num_rows ($consulta);

      if ($nfilas > 0)
      {
      // Mostrar n�meros inicial y final de las filas a mostrar
         print ("<P>Mostrando viviendas " . ($comienzo + 1) . " a ");
         if (($comienzo + $num) < $nfilas)
            print ($comienzo + $num);
         else
            print ($nfilas);
         print (" de un total de $nfilas.\n");

      // Mostrar botones anterior y siguiente
         $estapagina = $_SERVER['PHP_SELF'];
         if ($nfilas > $num)
         {
            if ($comienzo > 0)
               print ("[ <A HREF='$estapagina?comienzo=" . ($comienzo - $num) . "'>Anterior</A> | ");
            else
               print ("[ Anterior | ");
            if ($nfilas > ($comienzo + $num))
               print ("<A HREF='$estapagina?comienzo=" . ($comienzo + $num) . "'>Siguiente</A> ]\n");
            else
               print ("Siguiente ]\n");
         }
         print ("</P>\n");
      }

   // Enviar consulta
      $instruccion = "select * from viviendas order by precio asc limit $comienzo, $num";
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
         print ("<TH WIDTH='75'>Tama�o</TH>\n");
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

// Cerrar conexi�n
   mysql_close ($conexion);

?>

</BODY>
</HTML>
