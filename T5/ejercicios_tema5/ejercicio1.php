<?PHP
   session_start ();
?>

<HTML LANG="es">

<HEAD>
   <TITLE>Manejo de sesiones</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">
</HEAD>

<BODY>

<H1>Manejo de sesiones</H1>

<H2>Paso 1: se crea la variable de sesión y se almacena</H2>

<?PHP
// Con register_globals On
//   $var = "María";
//   session_register ("var");
//   print ("<P>Valor de la variable de sesión: $var</P>\n");

// Con register_globals Off
   $var = "María";
   $_SESSION['var'] = $var;
   print ("<P>Valor de la variable de sesión: $var</P>\n");
?>

<A HREF="ejercicio1b.php">Paso 2</A>.

</BODY>
</HTML>
