<HTML LANG="es">

<HEAD>
   <TITLE>El formulario de PHP</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">
</HEAD>

<BODY>

<?PHP
   if (isset($_REQUEST['buscar']))
   {
      print ("<H1>El formulario de PHP. Resultados del formulario</H1>\n");

      $texto = $_REQUEST['texto'];
      $donde = $_REQUEST['donde'];
      $genero = $_REQUEST['genero'];

      print ("<P>Estos son los datos introducidos:</P>\n");
      print ("<UL>\n");
      print ("   <LI>Texto de búsqueda: $texto\n");
      print ("   <LI>Buscar en: $donde\n");
      print ("   <LI>Género: $genero\n");
      print ("</UL>\n");
      print ("<P>[ <A HREF='ejercicio3.php'>Nueva búsqueda</A> ]</P>\n");
   }
   else
   {
?>

<H1>El formulario de PHP</H1>

<H2>Búsqueda de canciones</H2>

<FORM CLASS="borde" ACTION="ejercicio3.php" METHOD="POST">

<P><LABEL>Texto a buscar:</LABEL>
<INPUT TYPE="TEXT" SIZE="40" NAME="texto"></P>

<P><LABEL>Buscar en:</LABEL>
<INPUT TYPE="RADIO" NAME="donde" VALUE="titulo">Títulos de canción
<INPUT TYPE="RADIO" NAME="donde" VALUE="album">Nombres de álbum
<INPUT TYPE="RADIO" NAME="donde" VALUE="ambos" CHECKED>Ambos campos</P>

<P><LABEL>Género musical:</LABEL>
<SELECT NAME="genero">
   <OPTION SELECTED>Todos
   <OPTION>Acústica
   <OPTION>Banda Sonora
   <OPTION>Blues
   <OPTION>Electrónica
   <OPTION>Folk
   <OPTION>Jazz
   <OPTION>New Age
   <OPTION>Pop
   <OPTION>Rock
</SELECT></P>

<P><INPUT TYPE="SUBMIT" NAME="buscar" VALUE="Buscar"></P>

</FORM>

<?PHP
   }
?>

</BODY>
</HTML>
