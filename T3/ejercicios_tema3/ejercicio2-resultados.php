<HTML LANG="es">

<HEAD>
   <TITLE>Elementos de entrada. Resultados del formulario</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">
</HEAD>

<BODY>

<H1>Elementos de entrada. Resultados del formulario</H1>

<H2>Elementos  de tipo INPUT</H2>

<H3>TEXT</H3>
<?PHP
   //print ($cadena);
   print ($_REQUEST ['cadena']);
?>
<HR>

<H3>RADIO</H3>
<?PHP
   //print ($sexo);
   print ($_REQUEST ['sexo']);
?>
<HR>

<H3>CHECKBOX</H3>
<?PHP
   $n = count ($extras);
   //for ($i=0; $i<$n; $i++)
      //print ("$extras[$i]<BR>\n");
   foreach ($_REQUEST['extras'] as $extra)
      print ("$extra<BR>\n");
?>
<HR>

<H3>BUTTON</H3>
<?PHP
   //if ($actualizar)
      //print ("Se han actualizado los datos");
   if ($_REQUEST ['actualizar'])
      print ("Se han actualizado los datos");
?>
<HR>

<H3>FILE</H3>
(Véase <A HREF="ejercicio4.php">ejercicio 4</A> para la subida de ficheros)
<HR>

<H3>HIDDEN</H3>
<?PHP
   //print ($username);
   print ($_REQUEST ['username']);
?>
<HR>

<H3>PASSWORD</H3>
<?PHP
   //print ($clave);
   print ($_REQUEST ['clave']);
?>
<HR>

<H3>SUBMIT</H3>
<?PHP
   //if ($enviar)
      //print ("Se ha pulsado el botón de enviar");
   if ($_REQUEST ['enviar'])
      print ("Se ha pulsado el botón de enviar");
?>
<HR>

<H2>Elemento SELECT</H2>

<H3>SELECT SIMPLE</H3>
<?PHP
   //print ($color);
   print ($_REQUEST ['color']);
?>
<HR>

<H3>SELECT MÚLTIPLE</H3>
<?PHP
   $n = count ($idiomas);
   //for ($i=0; $i<$n; $i++)
      //print ("$idiomas[$i]<BR>\n");
   foreach ($_REQUEST['idiomas'] as $idioma)
      print ("$idioma<BR>\n");
?>
<HR>

<H2>Elemento TEXTAREA</H2>
<?PHP
   //print ($comentario);
   print ($_REQUEST ['comentario']);
?>

<BR><BR>
[ <A HREF='javascript:history.back()'>Volver</A> ]

</BODY>
</HTML>
