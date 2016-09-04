<HTML LANG="es">

<HEAD>
   <TITLE>Saludo</TITLE>
</HEAD>

<BODY>

<H1>Página de bienvenida</H1>

<?PHP
   $nombre = "María";
   $hora = date ("H");

   if ($hora >= 8 && $hora < 14)
      $saludo = "Buenos días, ";
   else if ($hora >= 14 && $hora <= 20)
      $saludo = "Buenas tardes, ";
   else
      $saludo = "Buenas noches, ";
   $saludo = $saludo . $nombre;
   print ($saludo);
?>

</BODY>
</HTML>
