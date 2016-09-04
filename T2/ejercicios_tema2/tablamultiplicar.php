<HTML LANG="ES">

<HEAD>
   <TITLE>Tabla de multiplicar</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">
</HEAD>

<BODY>

<H1>Tabla de multiplicar</H1>

<?PHP

   $n = 7;
   print ("<P>La tabla de multiplicar del $n es:</P>\n");
   for ($i=1; $i<=10; $i++)
      print ("$n x $i = " . $n*$i . "<BR>\n");

?>

</BODY>
</HTML>
