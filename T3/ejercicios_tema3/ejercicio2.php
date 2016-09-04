<HTML LANG="es">

<HEAD>
   <TITLE>Elementos de entrada</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">
</HEAD>

<BODY>

<H1>Elementos de entrada</H1>

<FORM ACTION="ejercicio2-resultados.php" METHOD="POST" ENCTYPE="multipart/form-data">

<H2>Elementos  de tipo INPUT</H2>

<H3>TEXT</H3>
Introduzca la cadena a buscar:
<INPUT TYPE="text" NAME="cadena" VALUE="valor por defecto" SIZE="20">
<HR>

<H3>RADIO</H3>
Sexo:
<INPUT TYPE="radio" NAME="sexo" VALUE="mujer" CHECKED>Mujer
<INPUT TYPE="radio" NAME="sexo" VALUE="hombre">Hombre
<HR>

<H3>CHECKBOX</H3>
Extras:
<INPUT TYPE="checkbox" NAME="extras[]" VALUE="garaje" CHECKED>Garaje
<INPUT TYPE="checkbox" NAME="extras[]" VALUE="piscina">Piscina
<INPUT TYPE="checkbox" NAME="extras[]" VALUE="jardin">Jardín
<HR>

<H3>BUTTON</H3>
<INPUT TYPE="button" NAME="actualizar" VALUE="Actualizar datos">
<HR>

<H3>FILE</H3>
Fichero:
<INPUT TYPE="file" NAME="fichero">
<HR>

<H3>HIDDEN</H3>
<?PHP
   $usuario = "mariano";
   print ("<INPUT TYPE='hidden' NAME='username' VALUE='$usuario'>\n");
?>
<HR>

<H3>PASSWORD</H3>
Contraseña: <INPUT TYPE="password" NAME="clave">
<HR>

<H3>SUBMIT</H3>
<INPUT TYPE="submit" NAME="enviar" VALUE="Enviar datos">
<HR>

<H2>Elemento SELECT</H2>

<H3>SELECT SIMPLE</H3>
Color:
<SELECT NAME="color">
   <OPTION VALUE="rojo" SELECTED>Rojo
   <OPTION VALUE="verde">Verde
   <OPTION VALUE="azul">Azul
</SELECT>
<HR>

<H3>SELECT MÚLTIPLE</H3>
Idiomas:
<SELECT MULTIPLE SIZE="3" NAME="idiomas[]">
   <OPTION VALUE="ingles" SELECTED>Inglés
   <OPTION VALUE="frances">Francés
   <OPTION VALUE="aleman">Alemán
   <OPTION VALUE="holandes">Holandés
</SELECT>
<HR>

<H2>Elemento TEXTAREA</H2>
Comentario:
<TEXTAREA COLS="50" ROWS="5" NAME="comentario">
Este libro me parece ...
</TEXTAREA>
<BR><BR>
<HR>

<BR>
<INPUT TYPE="SUBMIT" NAME="enviar" VALUE="enviar">
<INPUT TYPE="RESET" VALUE="borrar datos">

</FORM>

</BODY>
</HTML>
