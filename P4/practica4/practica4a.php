<HTML LANG="es">

<HEAD>
   <TITLE>Manejo de cadenas</TITLE>

<?PHP
   require ("cadena.php");
?>

</HEAD>

<BODY>

<H1>Manejo de cadenas</H1>

<H2>Ejemplo 1</H2>
<?PHP
   $fichero = "curriculum.pdf";
   $extension = calcula_extension ($fichero);
   $tipo = tipo_fichero ($extension);
   print ("El fichero '$fichero' es de tipo '$tipo'.\n");
?>

</BODY>
</HTML>
