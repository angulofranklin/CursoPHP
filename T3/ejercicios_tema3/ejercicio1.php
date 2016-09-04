<HTML LANG="es">

<HEAD>
   <TITLE>Formulario simple</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">
</HEAD>

<BODY>

<H1>Formulario simple</H1>

<H2>Búsqueda de canciones</H2>

<FORM CLASS="borde" ACTION="ejercicio1-resultados.php" METHOD="POST">

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

</BODY>
</HTML>
