<HTML LANG="es">

<HEAD>
   <TITLE>Manejo de cadenas</TITLE>

</HEAD>

<BODY>

<H1>Manejo de cadenas</H1>

<H2>Ejemplo 2</H2>
<?PHP
   $texto = "uno-dos-tres-cuatro-cinco";
   $lineas = explode ("-", $texto);
   $n_lineas = count ($lineas);

   print ("<UL>\n");
   for ($i=0; $i<$n_lineas; $i++)
      print ("   <LI>$lineas[$i]</LI>\n");
   print ("</UL>\n");
?>

</BODY>
</HTML>
