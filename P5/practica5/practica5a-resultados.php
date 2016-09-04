<HTML LANG="es">

<HEAD>
   <TITLE>Conversor de euros a pesetas. Resultados del formulario</TITLE>
</HEAD>

<BODY>

<H1>Conversor de euros a pesetas</H1>

<?PHP
   define ("EUROPTS", 166.386);

   $euros = $_REQUEST['euros'];
   if ($euros == "")
      print ("<P>Debe introducir una cantidad</P>\n");
   else
   {
      $pesetas = $euros*EUROPTS;
      print ("<P>$euros euro(s) equivale(n) a $pesetas pesetas</P>\n");
   }
?>

<P>[ <A HREF='javascript:history.back()'>Volver</A> ]</P>

</BODY>
</HTML>
