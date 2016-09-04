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

<H2>Paso 2: se accede a la variable de sesión almacenada y se destruye</H2>

<?PHP
// Con register_globals On
//   print ("<P>Valor de la variable de sesión: $var</P>\n");
//   session_unregister ("var");

// Con register_globals Off
   $var = $_SESSION['var'];
   print ("<P>Valor de la variable de sesión: $var</P>\n");
   unset ($_SESSION['var']);
?>

<A HREF="ejercicio1c.php">Paso 3</A>.

</BODY>
</HTML>
