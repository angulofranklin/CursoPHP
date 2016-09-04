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

<H2>Paso 3: la variable ya ha sido destruida y su valor se ha perdido</H2>

<?PHP
// Con register_globals On
//   print ("<P>Valor de la variable de sesión: $var</P>\n");
//   session_destroy ();

// Con register_globals Off
   $var = $_SESSION['var'];
   print ("<P>Valor de la variable de sesión: $var</P>\n");
   session_destroy ();
?>

<A HREF="ejercicio1.php">Volver al paso 1</A>.

</BODY>
</HTML>
