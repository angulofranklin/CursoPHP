<HTML LANG="es">

<HEAD>
   <TITLE>Eliminación de noticias</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">

<?PHP
// Incluir bibliotecas de funciones
   include ("lib/fecha.php");
?>

</HEAD>

<BODY>

<H1>Eliminación de noticias</H1>

<?PHP

   $eliminar = $_REQUEST['eliminar'];
   if (isset($eliminar))
   {

   // Conectar con el servidor de base de datos
      $conexion = mysql_connect ("localhost", "cursophp-ad", "php.hph")
         or die ("No se puede conectar con el servidor");

   // Seleccionar base de datos
      mysql_select_db ("lindavista")
         or die ("No se puede seleccionar la base de datos");

   // Obtener número de noticias a borrar
      $borrar = $_REQUEST['borrar'];
      $nfilas = count ($borrar);

   // Mostrar noticias a borrar
      for ($i=0; $i<$nfilas; $i++)
      {

      // Obtener datos de la noticia i-ésima
         $instruccion = "select * from noticias where id = $borrar[$i]";
         $consulta = mysql_query ($instruccion, $conexion)
            or die ("Fallo en la consulta");
         $resultado = mysql_fetch_array ($consulta);

      // Mostrar datos de la noticia i-ésima
         print ("Noticia eliminada:\n");
         print ("<UL>\n");
         print ("   <LI>Título: " . $resultado['titulo']);
         print ("   <LI>Texto: " . $resultado['texto']);
         print ("   <LI>Categoría: " . $resultado['categoria']);
         print ("   <LI>Fecha: " . date2string($resultado['fecha']));
         if ($resultado['imagen'] != "")
            print ("   <LI>Imagen: " . $resultado['imagen']);
         else
            print ("   <LI>Imagen: (no hay)");
         print ("</UL>\n");

      // Eliminar noticia
         $instruccion = "delete from noticias where id = $borrar[$i]";
         $consulta = mysql_query ($instruccion, $conexion)
            or die ("Fallo en la eliminación");

      // Borrar imagen asociada si existe
         if ($resultado['imagen'] != "")
         {
            $nombreFichero = "img/" . $resultado['imagen'];
            unlink ($nombreFichero);
         }

      }
      print ("<P>Número total de noticias eliminadas: " . $nfilas . "</P>\n");

   // Cerrar conexión
      mysql_close ($conexion);

      print ("<P>[ <A HREF='elimina_noticia.php'>Eliminar más noticias</A> ]</P>\n");

   }
   else
   {

   // Conectar con el servidor de base de datos
      $conexion = mysql_connect ("localhost", "cursophp-ad", "php.hph")
         or die ("No se puede conectar con el servidor");

   // Seleccionar base de datos
      mysql_select_db ("lindavista")
         or die ("No se puede seleccionar la base de datos");

   // Enviar consulta
      $instruccion = "select * from noticias order by fecha desc";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");

   // Mostrar resultados de la consulta
      $nfilas = mysql_num_rows ($consulta);
      if ($nfilas > 0)
      {
         print ("<FORM ACTION='elimina_noticia.php' METHOD='post'>\n");

         print ("<TABLE>\n");
         print ("<TR>\n");
         print ("<TH>Título</TH>\n");
         print ("<TH>Texto</TH>\n");
         print ("<TH>Categoría</TH>\n");
         print ("<TH>Fecha</TH>\n");
         print ("<TH>Imagen</TH>\n");
         print ("<TH>Borrar</TH>\n");
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

            print ("<TD><INPUT TYPE='CHECKBOX' NAME='borrar[]' VALUE='" .
               $resultado['id'] . "'></TD>\n");

            print ("</TR>\n");
         }

         print ("</TABLE>\n");

         print ("<BR>\n");
         print ("<INPUT TYPE='SUBMIT' NAME='eliminar' VALUE='Eliminar noticias marcadas'>\n");
         print ("</FORM>\n");
      }
      else
         print ("No hay noticias disponibles");

   // Cerrar conexión
      mysql_close ($conexion);

   }

?>

</BODY>
</HTML>
