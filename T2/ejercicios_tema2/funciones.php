<HTML LANG="ES">

<HEAD>
   <TITLE>Tablas y funciones</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">

<?PHP
// Función que obtiene el nombre de un mes
   function nombreMes ($mes)
   {
      $meses = array ("enero", "febrero", "marzo", "abril", "mayo",
                      "junio", "julio", "agosto", "septiembre",
                      "octubre", "noviembre", "diciembre");
      $i=0;
      $enc=false;
      while ($i<12 and !$enc)
      {
         if ($i == $mes-1)
            $enc = true;
         else
            $i++;
      }
      return ($meses[$i]);
   }
?>

</HEAD>

<BODY>

<H1>Tablas y funciones</H1>

<?PHP
   $dia  = date ("j");
   $mes  = date ("n");
   $anyo = date ("Y");
   print ("Hoy es " . $dia . " de " . nombreMes($mes) . " de " . $anyo . "<BR>\n");
?>

</BODY>
</HTML>
