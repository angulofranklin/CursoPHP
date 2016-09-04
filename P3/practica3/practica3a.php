<HTML LANG="es">

<HEAD>
   <TITLE>Tabla de conversión de euros a pesetas</TITLE>
</HEAD>

<BODY>

<H1>Conversión euros/pesetas</H1>

<?PHP
   define ("EUROPTS", "166.386");
   for ($i=1; $i<=10; $i++)
      print ("$i € = " . $i*EUROPTS . " pts<BR>\n");
?>

</BODY>
</HTML>
