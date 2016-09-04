<HTML LANG="es">

<HEAD>
   <TITLE>Generación de formularios desde PHP. Resultados del formulario</TITLE>
</HEAD>

<BODY>

<H1>Generación de formularios desde PHP</H1>

<?PHP
   $select = $_REQUEST['select'];
   print ("<P>La opción seleccionada es: $select</P>\n");
?>

<P>[ <A HREF='javascript:history.back()'>Volver</A> ]</P>

</BODY>
</HTML>
