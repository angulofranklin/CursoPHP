<HTML LANG="es">

<HEAD>
   <TITLE>Tabla de conversión de euros a pesetas</TITLE>
</HEAD>

<BODY>

<H1>Conversión euros/pesetas</H1>

<?PHP

   define ("EUROPTS", "166.386");

   print ("<TABLE WIDTH='200'>\n");
   print ("<TR BGCOLOR='#FFEECC'>\n");
   print ("   <TH>Euros</TH>\n");
   print ("   <TH>Pesetas</TH>\n");
   print ("</TR>\n");
   $color0 = "#CCCCCC";
   $color1 = "#CCEEFF";
   for ($i=1; $i<=10; $i++)
   {
      $j = $i%2;
      $colorFila = "color" . $j;
      print ("<TR ALIGN='CENTER' BGCOLOR=${$colorFila}>\n");
      print ("   <TD>$i</TD>\n");
      print ("   <TD>" . $i*EUROPTS . "</TD>\n");
      print ("</TR>\n");
   }
   print ("</TABLE>\n");
?>

</BODY>
</HTML>
