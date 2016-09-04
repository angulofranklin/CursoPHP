<HTML LANG="es">

<HEAD>
   <TITLE>Encuesta. Resultados de la votación</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">
</HEAD>

<BODY>

<H1>Encuesta. Resultados de la votación</H1>

<?PHP

   // Conectar con la base de datos
      $connection = mysql_connect ("localhost", "cursophp", "")
         or die ("No se puede conectar al servidor");
      mysql_select_db ("lindavista")
         or die ("No se puede seleccionar BD");

   // Obtener datos actuales de la votación
      $instruccion = "select * from votos";
      $consulta = mysql_query ($instruccion, $connection)
         or die ("Fallo en la selección");
      $resultado = mysql_fetch_array ($consulta);

      $votos1 = $resultado["votos1"];
      $votos2 = $resultado["votos2"];
      $totalVotos = $votos1 + $votos2;

   // Mostrar gráfico de tarta
      print ("<IMG ALT='Tarta' SRC='encuesta-tarta.php?votos1=$votos1&votos2=$votos2'>\n");

      print ("<P>Número total de votos emitidos: $totalVotos </P>\n");

      print ("<P><A HREF='encuesta.php'>Página de votación</A></P>\n");

   // Desconectar
      mysql_close ($connection);

?>

</BODY>
</HTML>
