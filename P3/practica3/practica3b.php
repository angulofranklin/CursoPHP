<HTML LANG="es">

<HEAD>
   <TITLE>Tabla de conversión de euros a pesetas</TITLE>
</HEAD>

<BODY>

<H1>Conversión euros/pesetas</H1>

<?PHP

   define ("EUROPTS", "166.386");

   print ("<TABLE BORDER WIDTH='200'>\n");
   print ("<TR>\n");
   print ("   <TH>Euros</TH>\n");
   print ("   <TH>Pesetas</TH>\n");
   print ("</TR>\n");
   for ($i=1; $i<=10; $i++)
   {
      print ("<TR ALIGN='CENTER'>\n");
      print ("   <TD>$i</TD>\n");
      print ("   <TD>" . $i*EUROPTS . "</TD>\n");
      print ("</TR>\n");
   }
   print ("</TABLE>\n");
?>

</BODY>
</HTML>
