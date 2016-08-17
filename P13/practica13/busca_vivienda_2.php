<?PHP
// Iniciar sesión
   session_start ();

// Obtener valores introducidos en el formulario
   $buscar = $_REQUEST['buscar'];
   $zona = $_REQUEST['zona'];

// Obtener valores almacenados en la sesión
   $tipo = $_SESSION['tipo'];

   $error = false;
   if (isset($buscar))
   {

   // Comprobar errores
   // Zona
      if ($zona == "Seleccione:")
      {
         $errores["zona"] = "Debe seleccionar la zona donde buscar la vivienda";
      	 $error = true;
      }
      else
         $errores["zona"] = "";
   }

// Si los datos son correctos, procesar formulario
   if (isset($buscar) && $error==false)
   {
   // Almacenar variable en la sesión
      $_SESSION['zona'] = $zona;

   // Ir al siguiente paso
      header ("Location: busca_vivienda_3.php");
   }
   else
   {
?>

<HTML LANG="es">

<HEAD>
   <TITLE>Búsqueda de vivienda</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">

   <SCRIPT LANGUAGE='JavaScript'>
   <!--
      function cargaPagina (pagina)
      {
         window.location=pagina;
      }
   // -->
   </SCRIPT>

</HEAD>

<BODY>

<H1>Búsqueda de vivienda</H1>

<P CLASS="paso">1. Tipo > <SPAN CLASS="pasoactual">2. Zona</SPAN> > 3. Características > 4. Extras</P>

<H2>Paso 2: Elija la zona de la vivienda</H2>

<FORM CLASS="borde" ACTION="busca_vivienda_2.php" METHOD="POST">

<P><LABEL>Zona:</LABEL>
<SELECT NAME="zona">
<?PHP
   $zonas = array ("Seleccione:", "Centro", "Nervión", "Triana", "Aljarafe",
                   "Macarena");
   $default ="Seleccione:";
   if (isset($buscar)) $default = $zona;
   if (isset($_SESSION['zona'])) $default = $_SESSION['zona'];
   foreach ($zonas as $z)
      if ($z == $default) 
         print ("<OPTION VALUE='$z' SELECTED>$z\n");
      else  
         print ("<OPTION VALUE='$z'>$z\n");
   print ("</SELECT>\n");
   if ($errores["zona"] != "")
      print ("<BR><SPAN CLASS='error'>" . $errores["zona"] . "</SPAN>");
?>
</P>

<P><INPUT TYPE="BUTTON" VALUE="< Anterior" ONCLICK="cargaPagina('busca_vivienda_1.php')">
<INPUT TYPE="submit" NAME="buscar" VALUE="Siguiente >"></P>

</FORM>

<?PHP
// Mostrar datos recogidos
   print ("<P>Buscando $tipo</P>\n");

   }
?>

</BODY>
</HTML>