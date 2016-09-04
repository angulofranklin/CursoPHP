<HTML LANG="es">

<HEAD>
   <TITLE>Consulta de noticias</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">

<SCRIPT LANGUAGE='JavaScript'>
<!--
// Función que actualiza la página al cambiar la categoría de noticia
   function actualizaPagina ()
   {
      i = document.forms.selecciona.categoria.selectedIndex;
      categoria = document.forms.selecciona.categoria.options[i].value;
      window.location = 'consulta_noticias4.php?categoria=' + categoria;
   }
// -->
</SCRIPT>

<?PHP
// Incluir bibliotecas de funciones
   include ("lib/fecha.php");
?>

</HEAD>

<BODY>

<H1>Consulta de noticias</H1>

<?PHP

   // Conectar con el servidor de base de datos
      $conexion = mysql_connect ("localhost", "cursophp", "")
         or die ("No se puede conectar con el servidor");

   // Seleccionar base de datos
      mysql_select_db ("lindavista")
         or die ("No se puede seleccionar la base de datos");

   // Mostrar formulario con elemento SELECT para seleccionar categoría de noticia
      print ("<FORM NAME='selecciona' ACTION='consulta_noticias4.php' METHOD='POST'>\n");
      print ("<P>Mostrar noticias de la categoría:\n");
      print ("<SELECT NAME='categoria' ONCHANGE='actualizaPagina()'>\n");

   // Obtener los valores del tipo enumerado
      $instruccion = "SHOW columns FROM noticias LIKE 'categoria'";
      $consulta = mysql_query ($instruccion, $conexion);
      $row = mysql_fetch_array ($consulta);

   // Pasar los valores a una tabla y añadir el valor "Todas" al principio
      $lis = strstr ($row[1], "(");
      $lis = ltrim ($lis, "(");
      $lis = rtrim ($lis, ")");
      $lis = "'Todas'," . $lis;
      $lista = explode (",", $lis);

   // Mostrar cada valor en un elemento OPTION
      $categoria = $_REQUEST['categoria'];
      if (isset($categoria))
         $selected = $categoria;
      else
         $selected = "Todas";
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
      $instruccion = "select * from noticias";

      if (isset($categoria) && $categoria != "Todas")
         $instruccion = $instruccion . " where categoria='$categoria'";

      $instruccion = $instruccion . " order by fecha desc";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");

   // Mostrar resultados de la consulta
      $nfilas = mysql_num_rows ($consulta);
      if ($nfilas > 0)
      {
         print ("<TABLE>\n");
         print ("<TR>\n");
         print ("<TH>Título</TH>\n");
         print ("<TH>Texto</TH>\n");
         print ("<TH>Categoría</TH>\n");
         print ("<TH>Fecha</TH>\n");
         print ("<TH>Imagen</TH>\n");
         print ("</TR>\n");

         for ($i=0; $i<$nfilas; $i++)
         {
            $resultado = mysql_fetch_array ($consulta);
            print ("<TR>\n");
            print ("<TD>" . $resultado['titulo'] . "</TD>\n");
            print ("<TD>" . $resultado['texto'] . "</TD>\n");
            print ("<TD>" . $resultado['categoria'] . "</TD>\n");
            print ("<TD>" . date2string($resultado['fecha']) . "</TD>\n");

            if ($resultado['imagen'] != "")
               print ("<TD><A TARGET='_blank' HREF='img/" . $resultado['imagen'] .
                      "'><IMG BORDER='0' SRC='img/ico-fichero.gif' ALT='Imagen asociada'></A></TD>\n");
            else
               print ("<TD>&nbsp;</TD>\n");

            print ("</TR>\n");
         }

         print ("</TABLE>\n");
      }
      else
         print ("No hay noticias disponibles");

// Cerrar conexión
   mysql_close ($conexion);

?>

</BODY>
</HTML>
